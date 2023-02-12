<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Arr;

class SocialShare
{
    /**
     * The url of the page to share
     *
     * @var string
     */
    protected $url;
    
    
    protected $socials = [
    'facebook' => '<li><a href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-facebook-square"></span></a></li>',
    'twitter' => '<li><a href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-twitter"></span></a></li>',
    'linkedin' => '<li><a href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-linkedin"></span></a></li>',
    'whatsapp' => '<li><a target="_blank" href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-whatsapp"></span></a></li>',
    'pinterest' => '<li><a href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-pinterest"></span></a></li>',
    'reddit' => '<li><a target="_blank" href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-reddit"></span></a></li>',
    'telegram' => '<li><a target="_blank" href=":url" class="social-button :class" id=":id" title=":title" rel=":rel"><span class="fab fa-telegram"></span></a></li>',
];
    
    protected $services = [
        'facebook' => [
            'uri' => 'https://www.facebook.com/sharer/sharer.php?u=',
        ],
        'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'text' => 'Default share text',
        ],
        'linkedin' => [
            'uri' => 'https://www.linkedin.com/sharing/share-offsite', // oud: http://www.linkedin.com/shareArticle
            'extra' => ['mini' => 'true'],
        ],
        'whatsapp' => [
            'uri' => 'https://wa.me/?text=',
            'extra' => ['mini' => 'true'],
        ],
        'pinterest' => [
            'uri' => 'https://pinterest.com/pin/create/button/?url=',
        ],
        'reddit' => [
            'uri' => 'https://www.reddit.com/submit',
            'text' => 'Default share text',
        ],
        'telegram' => [
            'uri' => 'https://telegram.me/share/url',
            'text' => 'Default share text',
        ],
    ];
    
    protected $fontAwesomeVersion = 5;

    /**
     * The generated urls
     *
     * @var string
     */
    protected $generatedUrls = [];

    /**
     * Optional text for Twitter
     * and Linkedin title
     *
     * @var string
     */
    protected $title;

    /**
     * Extra options for the share links
     *
     * @var array
     */
    protected $options = [];

    /**
     * Html to prefix before the share links
     *
     * @var string
     */
    protected $prefix = '<div id="social-links"><ul>';

    /**
     * Html to append after the share links
     *
     * @var string
     */
    protected $suffix = '</ul></div>';

    /**
     * The generated html
     *
     * @var string
     */
    protected $html = '';

    /**
     * Return a string with html at the end
     * of the chain.
     *
     * @return string
     */
    public function __toString()
    {
        $this->html = $this->prefix . $this->html;
        $this->html .= $this->suffix;

        return $this->html;
    }

    /**
     * @param string $url
     * @param string|null $title
     * @param array $options
     * @param string|null $prefix
     * @param string|null $suffix
     * @return $this
     */
    public function page($url, $title = null, $options = [], $prefix = null, $suffix = null)
    {
        $this->url = $url;
        $this->title = $title;
        $this->options = $options;
        $this->html = '';

        $this->setPrefixAndSuffix($prefix, $suffix);

        return $this;
    }

    /**
     * @param string|null $title
     * @param array $options
     * @param string|null $prefix
     * @param string|null $suffix
     * @return $this
     */
    public function currentPage($title = null, $options = [], $prefix = null, $suffix = null)
    {
        $url = request()->getUri();

        return $this->page($url, $title, $options, $prefix, $suffix);
    }

    /**
     * Facebook share link
     *
     * @return $this
     */
    public function facebook()
    {
        $url = $this->services['facebook']['uri'] . $this->url;

        $this->buildLink('facebook', $url);

        return $this;
    }

    /**
     * Twitter share link
     *
     * @return $this
     */
    public function twitter()
    {
        if (is_null($this->title)) {
            $this->title = $this->services['twitter']['text'];
        }

        $base = $this->services['twitter']['uri'];
        $url = $base . '?text=' . urlencode($this->title) . '&url=' . $this->url;

        $this->buildLink('twitter', $url);

        return $this;
    }

    /**
     * Reddit share link
     *
     * @return $this
     */
    public function reddit()
    {
        if (is_null($this->title)) {
            $this->title = $this->services['reddit']['text'];
        }

        $base = $this->services['reddit']['uri'];
        $url = $base . '?title=' . urlencode($this->title) . '&url=' . $this->url;

        $this->buildLink('reddit', $url);

        return $this;
    }

    /**
     * Telegram share link
     *
     * @return $this
     */
    public function telegram()
    {
        if (is_null($this->title)) {
            $this->title = $this->services['telegram']['text'];
        }

        $base = $this->services['telegram']['uri'];
        $url = $base . '?url=' . $this->url . '&text=' . urlencode($this->title);

        $this->buildLink('telegram', $url);

        return $this;
    }

    /**
     * Whatsapp share link
     *
     * @return $this
     */
    public function whatsapp()
    {
        $url = $this->services['whatsapp']['uri'] . $this->url;

        $this->buildLink('whatsapp', $url);

        return $this;
    }

    /**
     * Linked in share link
     *
     * @param string $summary
     * @return $this
     */
    public function linkedin($summary = '')
    {
        $base = $this->services['linkedin']['uri'];
        $mini = $this->services['linkedin']['extra']['mini'];
        $url = $base . '?mini=' . $mini . '&url=' . $this->url . '&title=' . urlencode($this->title) . '&summary=' . urlencode($summary);

        $this->buildLink('linkedin', $url);

        return $this;
    }

    /**
     * Pinterest share link
     *
     * @return $this
     */
    public function pinterest()
    {
        $url = $this->services['pinterest']['uri'] . $this->url;

        $this->buildLink('pinterest', $url);

        return $this;
    }

    /**
     * Get the raw generated links.
     *
     * @return string|array
     */
    public function getRawLinks()
    {
        if(count($this->generatedUrls) === 1) {
            return Arr::first($this->generatedUrls);
        }

        return $this->generatedUrls;
    }

    /**
     * Build a single link
     *
     * @param string $provider
     * @param string $url
     */
    protected function buildLink($provider, $url)
    {
        $fontAwesomeVersion = $this->fontAwesomeVersion;

        $this->rememberRawLink($provider, $url);

        $this->html .= trans("laravel-share::laravel-share-fa$fontAwesomeVersion.$provider", [
            'url' => $url,
            'class' => key_exists('class', $this->options) ? $this->options['class'] : '',
            'id' => key_exists('id', $this->options) ? $this->options['id'] : '',
            'title' => key_exists('title', $this->options) ? $this->options['title'] : '',
            'rel' => key_exists('rel', $this->options) ? $this->options['rel'] : '',
        ]);

    }

    /**
     * Optionally Set custom prefix and/or suffix
     *
     * @param string $prefix
     * @param string $suffix
     */
    protected function setPrefixAndSuffix($prefix, $suffix)
    {
        if (!is_null($prefix)) {
            $this->prefix = $prefix;
        }

        if (!is_null($suffix)) {
            $this->suffix = $suffix;
        }
    }

    /**
     * @param string $provider
     * @param string $socialNetworkUrl
     */
    protected function rememberRawLink($provider, $socialNetworkUrl)
    {
        $this->generatedUrls[$provider] = $socialNetworkUrl;
    }
}
