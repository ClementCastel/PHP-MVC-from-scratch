<?php
namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Post
{
    private $id;

    private $slug;

    private $name;

    private $content;

    private $created_at;

    private $categories = [];

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getExcerpt (): ?string
    {
        if ($this->content === null) {
            return null;
        } else {
            return nl2br(htmlentities(Text::excerpt($this->content, 60)));
        }
    }

    public function getCreatedAt (): DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

}