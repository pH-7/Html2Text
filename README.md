# HTML to Plain Text

A very simple "**HTML to Plain Text**" convertor 🪄

## 📄 Overview

[![Ko Fi - Offer Me A Coffee](media/kofi-logo.png)](https://ko-fi.com/phenry)

**Simplest. Clean. Efficient.** Just what you need to convert HTML code into plain text 🧹

## 🐘 PHP Requirement

[PHP v7.4](https://www.php.net/releases/7_4_0.php) or newer.


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

[![@phenrysay][twitter-image]](https://twitter.com/phenrysay) [![pH-7][github-image]](https://github.com/pH-7)

**[Pierre-Henry Soria](https://ph7.me)**, a highly passionate, zen &amp; pragmatic software engineer 😊

️☕️ Are you enjoying it...? You could **[offer me a coffee](https://ko-fi.com/phenry)** if you wish 😋


## ⚖️ License

**HTML to Text** is generously distributed under _[MIT](https://opensource.org/licenses/MIT)_ 🎉 Enjoy!


<!-- GitHub's Markdown reference links -->
[twitter-image]: https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white
[github-image]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
