<?php

namespace App\Repository\Admin;

use App\Interfaces\ImageVideoUpload;
use App\Models\AboutSection;
use App\Models\aboutSectionTranslation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AboutSectionRepo
{
    private ImageVideoUpload $ImageUpload;

    public function __construct(ImageVideoUpload $ImageUpload)
    {
        $this->ImageUpload = $ImageUpload;
    }

    /**
     * Edit About Section by position
     */
    public function edit(string $position): View
    {
        $data = AboutSection::with('translations:id,about_section_id,title,description,locale')
            ->firstOrCreate(['position' => $position]);

        $translations = $data->translations->keyBy('locale');

        return view('admin-panel.pages.about-sections.edit', compact('data', 'translations'));
    }

    /**
     * Update About Section
     *
     * @param  Request  $request
     */
    public function update($request): JsonResponse
    {
        $data_req = $request->only([
            'position',
            'linkVideo',
        ]);

        $data = AboutSection::firstOrCreate([
            'position' => $request->input('position'),
        ]);
        DB::beginTransaction();
        try {
            // Handle image
            if ($request->hasFile('image')) {
                $data_req['image'] = $this->ImageUpload->UpdateImageSingleWithOutLogo(
                    $request->file('image'),
                    'AboutSection',
                    $data->image
                );
            }

            // Update main model
            $data->update($data_req);

            // Update translations safely
            $titles = $request->input('title');
            $descriptions = $request->input('description');

            // تأكد إنهم arrays قبل foreach
            if (is_array($titles) && is_array($descriptions)) {
                foreach ($titles as $locale => $title) {
                    AboutSectionTranslation::updateOrCreate(
                        ['about_section_id' => $data->id, 'locale' => $locale],
                        [
                            'title' => $title,
                            'description' => $descriptions[$locale] ?? null,
                        ]
                    );
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
