<?php

namespace Imagine;

class StandardImage implements Image {
    protected $name;
    protected $type;
    protected $contentType;
    protected $content;
    protected $height;
    protected $width;
    protected $top;
    protected $left;
    protected $path;
    protected $processedImage;

	public function  __construct($path) {
        $pathInfo = pathinfo($path);
        if (false === ($size = getimagesize($path))) {
            throw new \InvalidArgumentException('Could not determine image info');
        }
        $this->setWidth($size[0]);
        $this->setHeight($size[1]);
        $this->setType($size[2]);
        $this->setContentType($size['mime']);
        $this->path = realpath($path);
        $this->setName($pathInfo['filename']);
        $this->setContent(file_get_contents($path));
	}

    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
	public function setType($type) {
		$this->type = $type;
	}
    public function getType() {
        return $this->type;
    }
    public function setContentType($contentType) {
		$this->contentType = $contentType;
	}
    public function getContentType() {
        return $this->contentType;
    }
    public function setContent($content) {
		$this->content = $content;
	}
    public function getContent() {
        return $this->content;
    }
    public function setHeight($height) {
		$this->height = $height;
	}
    public function getHeight() {
        return $this->height;
    }
    public function setWidth($width) {
		$this->width = $width;
	}
    public function getWidth() {
        return $this->width;
    }
    public function getPath() {
        return $this->path;
    }
    public function getProcessedImage() {
        return $this->processedImage;
    }
	public function getResource() {
		$content = $this->getContent();
		if (empty ($content)) {
			throw new \RuntimeException('Image was not instantiated or doesn\'t have content');
		}
		return imagecreatefromstring($this->getContent());
	}

	public function setSize($width, $height) {
		$this->setWidth($width);
		$this->setHeight($height);
	}
}

//    public function resize($width, $height) {
//        $srcImage = imagecreatefromstring($this->getContent());
//        $destImage = imagecreatetruecolor($width, $height);
//        if ( ! imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $width, $height, $this->width, $this->height)) {
//            throw new RuntimeException('Could not resize the image');
//        }
//        $this->width = $width;
//        $this->height = $height;
//        $this->processedImage = $destImage;
//        imagedestroy($srcImage);
//    }
//
//    public function crop($x, $y, $width, $height) {
//        $srcImage = imagecreatefromstring($this->getContent());
//        $destImage = imagecreatetruecolor($width, $height);
//        if ( ! imagecopy($destImage, $srcImage, 0, 0, $x, $y, $width, $height)) {
//            throw new RuntimeException('Could not resize the image');
//        }
//        $this->width = $width;
//        $this->height = $height;
//        $this->processedImage = $destImage;
//        imagedestroy($srcImage);
//    }
