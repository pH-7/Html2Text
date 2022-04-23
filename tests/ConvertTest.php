<?php
/**
 * @author    Pierre-Henry Soria <hi@ph7.me>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

declare(strict_types=1);

namespace PH7\HtmlToText\Tests;

use PH7\HtmlToText\Convert as Html2Text;
use PHPUnit\Framework\TestCase;

final class ConvertTest extends TestCase
{
    public function testConvertHtmlParagraph(): void
    {
        $htmlCode = '<p>This is a paragraph.</p>';
        $expectedOutput = <<<TEXT
This is a paragraph.
TEXT;

        $actual = (new Html2Text($htmlCode))->getText();
        $this->assertSame($expectedOutput, $actual);
    }

    public function testConvertBreakLineHtml(): void
    {
        $htmlCode = 'Hello<br />Bye';

        $expectedOutput = <<<TEXT
Hello
Bye
TEXT;

        $actual = (new Html2Text($htmlCode))->getText();
        $this->assertSame($expectedOutput, $actual);
    }

    public function testConvertListsHtml(): void
    {
        $htmlCode = '<ol><li>One</li><li>Two</li><li>Three</li></ol>';

        $expectedOutput = <<<TEXT
* One
* Two
* Three
TEXT;

        $actual = (new Html2Text($htmlCode))->getText();
        $this->assertSame($expectedOutput, $actual);
    }

    public function testConvertHtmlBody(): void
    {
        $htmlDocument = <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
</head>
<body>
<div class="center"><p>Hello World.</p></div>
</body>
</html>
HTML;

        $expectedOutput = <<<TEXT
Hello World.
TEXT;

        $actual = (new Html2Text($htmlDocument))->getText();

        $this->assertSame($expectedOutput, $actual);
    }

    public function testHtmlCodeContainingHtmlEntities(): void
    {
        $htmlCode = 'Hi&#44;&nbsp;You';
        $actual = (new Html2Text($htmlCode))->getText();

        $this->assertSame('Hi, You', $actual);
    }
}
