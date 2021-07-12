<?php

declare(strict_types=1);

namespace App\Tests\Post\domain;


use App\App\Post\Domain\Exception\TooLongPostContentException;
use App\App\Post\Domain\Validator\ContentValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContentValidatorTest extends KernelTestCase
{
    const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private ContentValidator $contentValidator;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->contentValidator = new ContentValidator();
    }

    /** @test */
    public function validate_post_content_which_should_be_fine()
    {
        $content = $this->generateRandomString(10);

        $this->assertEquals(true, $this->contentValidator->isValid($content));

    }

    /** @test */
    public function validate_notvalid_post_content_which_should_throw_error()
    {
        $content = $this->generateRandomString(10000);

        $this->expectException(TooLongPostContentException::class);
        $this->assertEquals(false, $this->contentValidator->isValid($content));

    }

    private function generateRandomString($length): string
    {
        $charactersLength = strlen(self::CHARACTERS);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= self::CHARACTERS[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}