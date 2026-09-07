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
    public function testBodyPreservesParagraphStructure(): void
    {
        $html = '<body><p>One</p><p>Two</p></body>';
        $this->assertSame("One\n\nTwo", (new Html2Text($html))->getText());
    }

    public function testBodyPreservesUtf8WithoutCharsetMetadata(): void
    {
        $this->assertSame('café 🧀', (new Html2Text('<body><p>café 🧀</p></body>'))->getText());
    }

    public function testUppercaseBodyExcludesTheHead(): void
    {
        $html = '<HTML><HEAD><TITLE>Hidden title</TITLE></HEAD><BODY><P>Visible</P></BODY></HTML>';
        $this->assertSame('Visible', (new Html2Text($html))->getText());
    }

    /** @dataProvider encodedTextCases */
    public function testEncodedTextRemainsLiteral(string $html, string $expected): void
    {
        $this->assertSame($expected, (new Html2Text($html))->getText());
    }

    public static function encodedTextCases(): array
    {
        return [
            ['Use &lt;code&gt; literally', 'Use <code> literally'],
            ['<body>Use &lt;code&gt; literally</body>', 'Use <code> literally'],
            ['&amp;lt;strong&amp;gt;', '&lt;strong&gt;'],
            ['<body>&amp;lt;strong&amp;gt;</body>', '&lt;strong&gt;'],
            ['&nbsp;Hi&#160;there&#xA0;', 'Hi there'],
        ];
    }

}
