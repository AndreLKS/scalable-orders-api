<?php
namespace App\DTOs;

class OrderData
{
    public function __construct(
        public int $user_id,
        public float $total_amount
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            total_amount: $data['total_amount']
        );
    }
}