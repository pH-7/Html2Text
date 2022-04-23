<?php
/**
 * @author    Pierre-Henry Soria <hi@ph7.me>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

declare(strict_types=1);

namespace PH7\HtmlToText;

use DOMDocument;

class Convert
{
    private const ENCODING = 'utf-8';

    private const ALLOWED_TAGS = '<p><br><li>';
    private const CLEAR_TAGS_PATTERN = '/<[^>]*>/';

    private string $htmlCode;
    private string $plainText;

    private array $rules = [
        // Remove HTML's whitespaces
        '/\s+/' => ' ',

        // Display link anchor with URL in parentheses
        '/<a(.*)href=[\'"](.*)[\'"]>(.*)<\/a>/Uis' => '$3 ($2)',

        // Replace <hr /> to newline
        '/<hr(.*)>/Uis' => "\n",

        // Replace br /> to newline
        '/<br(.*)>/Uis' => "\n",

        // Replace paragraph <p>PARAGRAPH</p> tag to newline in between the text
        '/<p(.*)>(.*)<\/p>/Uis' => "\n$2\n",

        // Lists
        '/(<ul\b[^>]*>|<\/ul>)/i' => "\n\n",
        '/(<ol\b[^>]*>|<\/ol>)/i' => "\n\n",
        '/(<dl\b[^>]*>|<\/dl>)/i' => "\n\n",

        '/<li\b[^>]*>(.*?)<\/li>/i' => "* $1\n",
        '/<dd\b[^>]*>(.*?)<\/dd>/i' => "$1\n",
        '/<dt\b[^>]*>(.*?)<\/dt>/i' => "* $1",

        // Parse table columns
        '/<tr>(.*)<\/tr>/Uis' => "\n$1",
        '/<td>(.*)<\/td>/Uis' => "$1\t",
        '/<th>(.*)<\/th>/Uis' => "$1\t",

        // h1-h6 headings to newline before and after
        '/<h1(.*)>(.*)<\/h1>/Uis' => "\n$2\n",
        '/<h2(.*)>(.*)<\/h2>/Uis' => "\n$2\n",
        '/<h3(.*)>(.*)<\/h3>/Uis' => "\n$2\n",
        '/<h4(.*)>(.*)<\/h4>/Uis' => "\n$2\n",
        '/<h5(.*)>(.*)<\/h5>/Uis' => "\n$2\n",
        '/<h6(.*)>(.*)<\/h6>/Uis' => "\n$2\n",

        //Surround tables with newlines
        '/<table(.*)>(.*)<\/table>/Uis' => "\n$2\n",

        // Remove any double whitespaces
        '/(  *)/' => ' ',
    ];

    public function __construct(string $htmlCode)
    {
        $this->htmlCode = $htmlCode;

        if (preg_match('/<body(.*)>/', $this->htmlCode)) {
            $dom = new DOMDocument();
            $dom->loadHTML($this->htmlCode);

            $this->htmlCode = $dom->getElementsByTagName('body')->item(0)->textContent;
        }

        $this->convertHtmlEntities();

        $this->parse();
    }

    private function parse(): void
    {
        foreach ($this->rules as $rule => $output) {
            $this->htmlCode = preg_replace($rule, $output, $this->htmlCode);
        }

        $this->plainText = strip_tags($this->htmlCode, self::ALLOWED_TAGS);
        $this->plainText = preg_replace(self::CLEAR_TAGS_PATTERN, PHP_EOL, $this->plainText);


        // Remove tabs before new lines
        $this->plainText = preg_replace('/\t /', "\t", $this->plainText);
        $this->plainText = preg_replace('/\t \n/', "\n", $this->plainText);
        $this->plainText = preg_replace('/\t\n/', "\n", $this->plainText);

        // Remove extra spaces
        $this->plainText = trim($this->plainText);
    }

    private function convertHtmlEntities(): void
    {
        $this->htmlCode = str_replace('&nbsp;', ' ', $this->htmlCode);
        $this->htmlCode = html_entity_decode($this->htmlCode, ENT_QUOTES | ENT_COMPAT , self::ENCODING);
        $this->htmlCode = html_entity_decode($this->htmlCode, ENT_HTML5, self::ENCODING);
        $this->htmlCode = html_entity_decode($this->htmlCode);
        $this->htmlCode = htmlspecialchars_decode($this->htmlCode);
    }

    public function getText(): string
    {
        return $this->plainText;
    }
}
