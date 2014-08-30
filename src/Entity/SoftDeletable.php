<?php

namespace BitWeb\DoctrineExtension\Entity;

interface SoftDeletable
{
    /**
     * Called on preRemove.
     */
    public function onDelete();
}
