<?php

namespace Jonas\ToDo\Model;

class Tasks
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private string $status;

    public function __construct(string $title, string $description, string $status) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
}
