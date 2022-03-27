<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->image();
        $fileName = explode(DIRECTORY_SEPARATOR, $image);
        $fileName = array_pop($fileName);
        $image = new UploadedFile($image, $fileName);
        $image->storeAs('public', $fileName);

        return [
            'path' => $fileName,
        ];
    }
}
