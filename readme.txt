=== HTML5 Chat ===
Contributors: cstsoftwarecorp
Tags: chat, tchat, webcam, videochat, visiochat
Requires at least: 6.4
Tested up to: 6.4
Stable tag: 1.05 
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html 
HTML5 Chat is a WordPress plugin that allows you to easily integrate video chat into your blog.

## Description

The HTML5 Chat plugin enables you to embed video chat from html5-videochat.com directly into your WordPress blog. Upon activating the plugin, you will receive an email containing your password.

To integrate audio and video chat into your blog, simply insert the provided shortcode into your page or post.

The HTML5 Chat plugin leverages the powerful video chat functionality provided by the external service html5-videochat.com. When the plugin is activated and configured, iframes are embedded in your website, connecting to the following external service:

- **Video Chat Service:** [https://www.html5-videochat.com/](https://www.html5-videochat.com/)

To ensure transparency and inform users about practices related to the use of this service, please carefully read the following documents:

- **Terms of Service for the Video Chat Service:** [Terms of Service](https://www.html5-videochat.com/index.php?/info-collegamenti/terms-and-conditions/)
- **Privacy Policies for the Video Chat Service:** [Privacy Policies](https://www.html5-videochat.com/index.php?/info-collegamenti/privacy-policy/)

These links provide details on the terms and data management related to the use of the video chat. Please review this information carefully to ensure full user awareness.

## Installation

1. Make sure to enable the `allow_url_fopen` and `opcache` options in the php.ini configuration file to ensure proper PHP environment functionality.
2. Activate the plugin. Upon activation, an account will be automatically created on [https://www.html5-videochat.com/](https://www.html5-videochat.com/), and login credentials will be sent to your email address.
3. Upon activation, you will automatically receive your password via email.
4. Insert the `[HTML5VIDEOCHAT width=100% height=640px]` shortcode into your page or post.
5. To make the chat fullscreen, use `height=fullscreen`. Example: `[HTML5VIDEOCHAT width=100% height=fullscreen]`
6. The chat requires users to specify their gender, as it distinguishes between males, females, or couples. By default, WordPress does not include a user gender field in the profile fields. Therefore, we recommend installing the BuddyPress plugin available at [https://it.wordpress.org/plugins/buddypress/](https://it.wordpress.org/plugins/buddypress/). Once installed, please refer to the tutorial on how to manage gender fields at the following link: [https://www.html5-videochat.com/index.php?/blogs/entry/52-to-properly-add-the-plugin-to-your-wordpress-site-follow-these-steps/](https://www.html5-videochat.com/index.php?/blogs/entry/52-to-properly-add-the-plugin-to-your-wordpress-site-follow-these-steps/).

## Frequently Asked Questions

- **Can I see a demo?**
  Sure! You can check out a demo here [https://www.html5-videochat.com/index.php?/videochat/1/](https://www.html5-videochat.com/index.php?/videochat/1/).

- **How do I change the width and height of the chat?**
  You can adjust the size by editing the `[HTML5VIDEOCHAT width=100% height=640px]` tag.

- **Which WordPress roles match the chat groups?** 
   Here are the corresponding groups: 
   Administrator will be assigned the admin role.
   Editor will be assigned the moderator role.
   Author will be assigned the premium role.
   Contributor will be assigned the deejay role.
   Subscriber will be assigned the user role.

- **How do I set the chat in full screen?**
  You can make the chat fullscreen by editing the `[HTML5VIDEOCHAT width=100% height=fullscreen]` tag.

- **Can I set up a earning system?**
  Absolutely! The video chat is designed to provide you with various earning opportunities. Firstly, you can receive donations directly through the integrated button in the video chat. Additionally, there's a profile chat system that allows you to earn 50% from shows created by users. It's an ideal option for camgirl sites or profile shows.

- **How do I earn with activated profile rooms?**
  By activating profile rooms, users who enter will automatically see the webcam activated. Users who enter a profile room of a user will need to send tokens to privately message, send whispers, and reach the goals of the user who is broadcasting. It's a real camgirl system that allows you to earn real money, both for you and the user who is broadcasting!

- **How can I moderate my chat?**
  Login to your chat through your WordPress admin. If you are the admin of your WordPress blog, you are automatically the admin of the chat.

- **How do I change the look and feel of my chat?**
  Customize the appearance and settings of your chat directly from the administrator control panel at [https://www.html5-videochat.com/](https://www.html5-videochat.com/). Once the chat is activated on your WordPress site, an account will be automatically created for you. You will receive an email with login credentials, giving you the ability to tailor the look of your chat to match your preferences.

- **How many languages are available for video chat? And how many of these languages do you have installed?**
The currently available languages are English, Spanish, Chinese, German, French, Italian, Arabic, Polish, Russian, Danish, Dutch (Netherlands). If you don't find your language in the list, we will translate it into your language shortly.

- **Who can I contact for support if I encounter issues with my chat?**
If you encounter any issues with the chat, please do not hesitate to contact us at ilfreeif@gmail.com or via WhatsApp at +393713892039. Our support team is available 24/7. Feel free to reach out for any information.

## Screenshots

1. ![Screenshot 1](https://ps.w.org/html5-videochat/assets/screenshot-1.png)

2. ![Screenshot 2](https://ps.w.org/html5-videochat/assets/screenshot-2.png)

3. ![Screenshot 3](https://ps.w.org/html5-videochat/assets/screenshot-3.png)

4. ![Screenshot 4](https://ps.w.org/html5-videochat/assets/screenshot-4.png)



## Domain and Third-Party Service Documentation

- **Domain Mentioned in README:** [https://www.html5-videochat.com/](https://www.html5-videochat.com/)
- **Third-Party Service Endpoint:** [https://www.html5-videochat.com/index.php?/wordpress/get-json-wp/](https://www.html5-videochat.com/index.php?/wordpress/get-json-wp/)

For transparency and to enhance understanding, this plugin utilizes the following third-party service endpoint:

- **Endpoint for WordPress Integration:** [https://www.html5-videochat.com/index.php?/wordpress/get-json-wp/](https://www.html5-videochat.com/index.php?/wordpress/get-json-wp/)

This endpoint is responsible for retrieving and processing user data from the WordPress environment. It handles the reception of POST requests, extracts essential user information, interacts with existing JSON files, and performs operations such as generating unique user identifiers and creating or updating user-specific JSON files. The endpoint is integral to the seamless integration of user data between WordPress and the html5-videochat.com service.


## Questions

Feel free to contact us at ilfreeif@gmail.com for further assistance.
