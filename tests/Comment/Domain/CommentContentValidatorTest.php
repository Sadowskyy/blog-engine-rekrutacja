<?php


namespace App\Tests\Comment\Domain;


use App\App\Comment\Domain\Exception\TooLongCommentContentException;
use App\App\Comment\Domain\Exception\TooShortCommentContent;
use App\App\Comment\Domain\Validator\CommentContentValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentContentValidatorTest extends KernelTestCase
{
    const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private CommentContentValidator $contentValidator;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->contentValidator = new CommentContentValidator();
    }
    
    /** @test */
    public function validate_comment_content_which_should_be_fine()
    {
        $content = $this->generateRandomString(30);

        $this->assertEquals(true, $this->contentValidator->isValid($content));
    }

    /** @test */
    public function validate_not_valid_comment_content_which_should_throw_error_about_too_long_content()
    {
        $content = $this->generateRandomString(300);

        $this->expectException(TooLongCommentContentException::class);
        $this->assertEquals(false, $this->contentValidator->isValid($content));
    }

    /** @test */
    public function validate_not_valid_comment_content_which_should_throw_error_about_too_short_content()
    {
        $content = $this->generateRandomString(5);

        $this->expectException(TooShortCommentContent::class);
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