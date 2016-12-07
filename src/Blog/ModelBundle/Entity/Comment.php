<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Blog\ModelBundle\Repository\CommentRepository")
 */
class Comment extends Timestampable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank
     */
    private $body;

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $post;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set body
     *
     * @param string $body
     *
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set post
     *
     * @param Post $post
     *
     * @return Comment
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set user
     *
     * @param \Blog\ModelBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\Blog\ModelBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Blog\ModelBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
