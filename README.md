# Social Feeds for Wordpress

**This project was created mostly for learning purposes and thus may not follow best practices and/or contain bugs.**

Currently this plugin only utilizes the Facebook API to pull public feeds. In the future, I plan to add Twitter at the very least.
I've purposefully created minimal styles that can easily be overwritten.

## Installation/Setup
+ Make sure cURL is installed and enabled - there is currently no check to make sure cURL exists on the system.
+ Upload and activate plugin
+ A Facebook App is required to use the API. Simply create an app and use the App Secret and App ID.
+ To get the Page ID, I use [http://findmyfbid.com/]http://findmyfbid.com/.

## Usage
Simply place the `[social-feeds]` shortcode on any page that you wish to display the feed. In the future, I will add options to the shortcode.

## License
### MIT License

Copyright (c) 2016 Andrew C. Anguiano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.