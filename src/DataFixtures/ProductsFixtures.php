<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProductsFixtures extends Fixture
{
    public const PRODUCTS = [
        ['image' => 'lg.jpg', 'name' => 'LG', 'price' => 200],
        ['image' => 'iphone.jpg', 'name' => 'Iphone', 'price' => 700],
        ['image' => 'samsung.jpg', 'name' => 'Samsung', 'price' => 550],
        ['image' => 'huawei.jpg', 'name' => 'Huawei', 'price' => 425],
        ['image' => 'nokia.jpg', 'name' => 'Nokia', 'price' => 200],
        ['image' => 'hp.jpg', 'name' => 'HP laptop', 'price' => 600],
    ];

    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadImageDir, recursive: true);
        }

        foreach (self::PRODUCTS as $productData) {
            copy(
                __DIR__ . '/data/images/' . $productData['image'],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $productData['image']
            );
            $product = new Products();
            $product
                ->setImage($productData['image'])
                ->setName($productData['name'])
                ->setPrice($productData['price']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
