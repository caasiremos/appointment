<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Utils\Filters\AppointmentFilter;
use App\Utils\Bookings\TimeSlotGenerator;
use App\Utils\Filters\SlotsPastTodayFilter;
use App\Utils\Filters\UnavailablilityFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    /**
     * Employee available timeslots for a given date
     * @param Schedule $schedule
     * @param Service $service
     * @return CarbonPeriod
     */
    public function availableTimeSlots(Schedule $schedule, Service $service)
    {
        return (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPastTodayFilter(),
                new UnavailablilityFilter($schedule->unavailabilities),
                new AppointmentFilter($this->appointmentsForDate($schedule->date))
            ])
            ->get();
    }

    /**
     * Returns appointment for a give date
     * @param Carbon $date
     * @return Collection
     */
    public function appointmentsForDate(Carbon $date): Collection
    {
        return $this->appointments()->whereDate('date', $date)->get();
    }

    /**
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
