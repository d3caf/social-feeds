(function($){

var feed = JSON.parse(fb_data.feed);

$(function(){
	outputFbFeed(feed.data, fb_data.fb_post_count);
});

var anchorOpts = {
	'attributes' : {
		'target': '_blank'
	},
	TLDs: 20,
}

// fetchNewsFeed(fb_vars.sf_facebook_pageid, fb_vars.sf_facebook_auth.appid, fb_vars.sf_facebook_auth.app_secret);
// This function is not used, since it would expose the App Secret/Key to public. Scripts.js does not receive this data.

function fetchNewsFeed(pid, appid, appsecret){
	$.ajax({
		url: 'https://graph.facebook.com/'+ pid +'/posts?access_token='+ appid + '|' + appsecret,
		complete: function(jqXHR, stat){
			outputFbFeed(jqXHR.responseJSON.data);
		}
	});
}

function outputFbFeed(feed, num_posts){
	for(i = 0; i < num_posts && i < feed.length; i++){
		var linked = anchorme.js(feed[i].message, anchorOpts); // find links in post text
		var timeago = $.timeago(feed[i].created_time);

		var output = '<li class="sf_fb-post-wrapper">';
			output += '<p>'+ linked +'</p>';
			output += '<a href="https://facebook.com/' + feed[i].id + '" target="_blank">'; 
			output += '<span class="sf_fb-post-timestamp"><svg style="width:18px;height:18px" viewBox="0 0 24 24"><path fill="grey" d="M19,4V7H17A1,1 0 0,0 16,8V10H19V13H16V20H13V13H11V10H13V7.5C13,5.56 14.57,4 16.5,4M20,2H4A2,2 0 0,0 2,4V20A2,2 0 0,0 4,22H20A2,2 0 0,0 22,20V4C22,2.89 21.1,2 20,2Z" /></svg>  &middot; ' + timeago +' </span>';
			output += '</a>';
			output += '</li>';

			$('div#sf-wrapper ul.sf-post-wrapper').append(output);
	}
	$('div#sf-wrapper ul.sf-post-wrapper h2.sf-loading').remove(); // clear the loading text
};

})(jQuery);
