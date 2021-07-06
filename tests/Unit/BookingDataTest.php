<?php

namespace Tests\Unit;

use App\Http\Requests\BookingStoreRequest;
use Domain\Bookings\DataTransferObjects\BookingData;
use Domain\Units\Models\Unit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class BookingDataTest extends TestCase
{

    /** @test */
    public function form_booking_store_request()
    {
        $unit = Unit::create();

        $dto = BookingData::fromStoreRequest(new BookingStoreRequest([
            'name' => 'test',
            'unit_id' => $unit->id,
            'date_start' => '2020-12-01',
            'date_end' => '2020-12-05'
        ]));

        $this->assertInstanceOf(BookingData::class, $dto);
    }

    /** @test */
    public function from_booking_store_store_request_without_unit_fails()
    {
        $this->expectException(ModelNotFoundException::class);

        BookingData::fromStoreRequest(new BookingStoreRequest([
            'name' => 'test',
            'date_start' => '2020-12-01',
            'date_end' => '2020-12-05'
        ]));
    }
}
