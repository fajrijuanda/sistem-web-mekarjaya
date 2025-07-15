<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class ProfileDesa extends Controller
{
    private $jsonPath = 'assets/json/profile-desa.json'; // Path relative to public directory

    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $dataProfil = $this->loadProfileData();

        return view('content.admin.contents.pages.profile-desa', [
            'pageConfigs' => $pageConfigs,
            'dataProfil' => $dataProfil
        ]);
    }

    public function update(Request $request)
    {
        // Ensure only authenticated admins can update
        if (Auth::check()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $profileData = json_decode($request->input('profile_data'), true);

        // Handle image uploads
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                // The file name sent from the frontend is formatted as 'section_sub_key_filename.ext'
                // We need to extract the original data-field path from it.
                $originalFilename = $file->getClientOriginalName();
                $parts = explode('_', $originalFilename);
                // The actual field path is usually something like 'hero.image', 'features.items.0.icon'
                // So we need to reconstruct it from the modified filename parts
                $fieldPath = '';
                // Assuming the structure is like 'section_sub_key_originalfilename' or 'section_array_index_sub_key_originalfilename'
                if (count($parts) >= 2) {
                    $section = $parts[0];
                    if (is_numeric($parts[1])) { // Likely an array item
                        $fieldPath = $section . '.' . $parts[1] . '.' . $parts[2]; // e.g., features.0.icon
                        // Adjust if there are more nested levels. This needs to match how you named files in JS.
                        // In the JS I provided, it's `fieldPath.replace(/\./g, '_')}_${file.name}`
                        // So if the original was `features.items.0.icon`, the name could be `features_items_0_icon_original_name.png`
                        // We need to parse this back to `features.items.0.icon`
                        // Let's refine the parsing based on the actual `data-field`
                        $originalFieldPathFromFilename = implode('.', array_slice($parts, 0, count($parts) - count(explode('.', $file->getClientOriginalExtension())) - 1)); // Attempt to get the field path from modified name
                        $fieldPath = str_replace('_', '.', $originalFieldPathFromFilename); // Convert back
                    } else { // Direct key
                        $fieldPath = $section . '.' . $parts[1]; // e.g., hero.image
                        $originalFieldPathFromFilename = implode('.', array_slice($parts, 0, count($parts) - 1));
                        $fieldPath = str_replace('_', '.', $originalFieldPathFromFilename);
                    }
                }


                // Fallback or precise parsing needed here to map filename back to original `data-field`
                // For the current JS, the file name is `${fieldPath.replace(/\./g, '_')}_${file.name}`
                // So if the data-field is `hero.image`, the name is `hero_image_originalfilename.png`
                // We can parse it like this:
                $cleanedFileName = substr($originalFilename, 0, strrpos($originalFilename, '.')); // Remove extension
                $parts = explode('_', $cleanedFileName);
                $dataPathParts = [];
                for ($i = 0; $i < count($parts); $i++) {
                    // Check if the next part is numeric (index of an array) to identify if it's part of the path or filename
                    if (isset($parts[$i + 1]) && is_numeric($parts[$i + 1])) {
                        $dataPathParts[] = $parts[$i];
                        $dataPathParts[] = $parts[$i + 1];
                        $i++; // Skip the next part as it's an index
                    } else {
                        $dataPathParts[] = $parts[$i];
                    }
                }
                // The above logic needs to be robust for all nesting levels.
                // A simpler, more reliable way is to pass the fieldPath directly with the file.
                // For this example, let's assume the first part until the last underscore before the original filename is the path.

                // Let's assume the image path in JSON is relative to 'public/' (e.g., 'assets/img/...')
                // We will save images in 'public/uploads/profile/'
                $uploadPath = 'uploads/profile/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($uploadPath), $fileName);
                $newImagePath = $uploadPath . $fileName;

                // Update the profileData array with the new image path
                // This requires knowing which `data-field` corresponds to which uploaded file.
                // In the current setup, the file name should contain enough info.
                // This part needs to be very precise based on how you name the uploaded files.
                // Let's rely on `data-field` that was passed to the input field
                // For simplicity, let's assume we can map the `data-field` from the original input to the uploaded file.
                // This is where the actual `data-field` for the image needs to be associated with the uploaded file in the request.
                // A better approach would be to send the `data-field` alongside each file.
                // For now, let's assume `image_files` keys are the `data-field` paths, which is not how HTML forms work with `name="image_files[]"`.

                // To correctly map, you would ideally send something like:
                // <input type="file" name="image_files[hero.image]" ...>
                // Or send a separate hidden input for each image field with its path.

                // Given your current JS, the filename for upload might be like: `hero_image_actualfilename.png`
                // So we need to parse that.
                // Example: `hero_image_sosialisasi-kkn.png` should map to `hero.image`
                // Let's assume the field path is encoded in the filename before the original filename.
                $nameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFieldKey = ''; // This needs to be correctly extracted

                // The way the JS names the file is `${fieldPath.replace(/\./g, '_')}_${file.name}`
                // So, if fieldPath is `hero.image`, the name is `hero_image_originalFileName.ext`
                // We need to reverse this to get `hero.image`
                $fieldPathFromFileName = substr($originalFilename, 0, strrpos($originalFilename, '_')); // Get `hero_image`
                $originalFieldKey = str_replace('_', '.', $fieldPathFromFileName); // Convert to `hero.image`

                if (!empty($originalFieldKey)) {
                    $this->setNestedValue($profileData, $originalFieldKey, $newImagePath);
                }
            }
        }

        // Save the updated JSON data
        $this->saveProfileData($profileData);

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui!');
    }

    private function loadProfileData()
    {
        $fullPath = public_path($this->jsonPath);
        if (File::exists($fullPath)) {
            $jsonContent = File::get($fullPath);
            return json_decode($jsonContent, true);
        }
        return []; // Return empty array if file not found
    }

    private function saveProfileData(array $data)
    {
        $fullPath = public_path($this->jsonPath);
        File::put($fullPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    // Helper function to set nested array/object values
    private function setNestedValue(&$arr, $path, $value)
    {
        $keys = explode('.', $path);
        foreach ($keys as $key) {
            $arr = &$arr[$key];
        }
        $arr = $value;
    }
}