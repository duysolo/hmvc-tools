<?php

namespace HMVCTools\Support;

class PageTitleSupport
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var string
     */
    protected $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * @param string $title
     * @return static
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $subtitle
     * @return static
     */
    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @param string $appName
     * @return static
     */
    public function setAppName(string $appName)
    {
        $this->appName = $appName;

        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $data = [];

        if ($this->title) {
            $data[] = $this->title;
        }

        if ($this->subtitle) {
            $data[] = $this->subtitle;
        }

        if ($this->appName) {
            $data[] = $this->appName;
        }

        return implode(' - ', $data);
    }

    /**
     * @return static
     */
    public function reset()
    {
        $this->title = '';

        $this->subtitle = '';

        $this->appName = config('app.name');

        return $this;
    }
}
