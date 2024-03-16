# Task

Create a webpage prototype for URLs shortener.

### Requirements

* Create a form, that allows adding URL and system generates short unique URL:
  * The format of generated URL: example.com/[hash];
  * The short URL must be a valid URL;
  * The URL must be shortened till 6 symbols hash, which contains alphanumeric symbols;
  * Algorithm must recognize duplicate URL and instead of generating new short URL, show previously
  created;
  * Upon submit, the URL should be checked using the „Google Safe Browsing“ API
(https://developers.google.com/safe-browsing/v4/lookup-api). Or any other API with the same
function.
* After implementation, upon opening the short URL, the user must be redirected to the original URL.
* Advantage, if functionality could work from folder (e.g.: example.com/something/[hash]).
* For implementation use Laravel and Vue.js.

As a result, provide MySQL dump and source code of the task.

# Implementation

Laravel Sail is used for simplicity

### Run

```bash
./vendor/bin/sail up -d
```

