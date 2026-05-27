# HTML to Plain Text

A simple, lightweight, and effective "**HTML to Plain Text**" converter for your PHP projects 🪄


## 📄 Overview

[![Ko Fi - Offer Me A Coffee](media/kofi-logo.png)](https://ko-fi.com/phenry)

**Simple. Clean. Efficient.** Just what you need to convert HTML code into plain text 🧹


## 🐘 PHP Requirement

* [PHP v7.4](https://www.php.net/releases/7_4_0.php) or newer.


## 🛠 Installation

```
composer require ph-7/html-to-text
```

If you don't already use composer in your project, include [Composer's autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading) as shown below in your main PHP index file of your project.

```php
require __DIR__ . '/vendor/autoload.php';
```


## 🥳 Usage

```php
use PH7\HtmlToText\Convert;

$htmlCode = '<div><p><em>Some random paragraphs...</em></p></div>';

$this->html2Text = new Convert($htmlCode);
$plainText = $this->html2Text->getText();

echo $plainText;
```


## 😋 Who cooked it?

[![Pierre-Henry Soria](https://s.gravatar.com/avatar/a210fe61253c43c869d71eaed0e90149?s=200)](https://ph7.me 'Pierre-Henry Soria personal website')

[![@phenrysay][x-badge]](https://x.com/phenrysay "Follow Me on X") [![@pH7Programming][yt-badge]](https://www.youtube.com/@pH7Programming/videos "YouTube Tech Videos") [![pH-7][github-badge]](https://github.com/pH-7 "My GitHub profile")

**[Pierre-Henry Soria](https://ph7.me)**. A super passionate, zen &amp; pragmatic software engineer 😊 Cheese & dark chocolate lover! 🧀🍫😋

️☕️ Are you enjoying it...? You could **[offer me a coffee](https://ko-fi.com/phenry)** if you wish 😋


## Projects using it 🚀

* [pH7Builder](https://github.com/pH7Software/pH7-Social-Dating-CMS) - [composer.json](https://github.com/pH7Software/pH7-Social-Dating-CMS/blob/99e16af40cbc9bb4de64d1c32e5c49f54a4717c2/composer.json#L73)


## ⚖️ License

**HTML to Text** is generously distributed under _[MIT](https://opensource.org/licenses/MIT)_ 🎉 Enjoy!


<!-- GitHub's Markdown reference links -->
[x-badge]: https://img.shields.io/badge/X-000000?style=for-the-badge&logo=x&logoColor=white
[yt-badge]: https://img.shields.io/badge/YouTube-FF0000?style=for-the-badge&logo=youtube&logoColor=white
[github-badge]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
