<?php

namespace API;

interface APIInterface
{
    public const FORMAT_JSON = 'json';
    public const FORMAT_XML = 'xml';
    
    //#[Route("/api/data", methods: ["GET"])]
    public function get();
    //#[Route("/api/data/{id}", methods: ["GET"])]
    public function getById($id);
    //#[Route("/api/data", methods: ["POST"])]
    public function create($data);
    //#[Route("/api/data", methods: ["PUT"])]
    public function update($data);
    //#[Route("/api/data/{id}", methods: ["DELETE"])]
    public function delete($id);
}
