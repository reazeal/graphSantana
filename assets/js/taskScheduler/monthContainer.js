/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23) 
|  |  .---------- day of month (1 - 31) 
|  |  |  .------- month (1 - 12)                    <-this
|  |  |  |  .---- day of week (0 - 7) (Sunday=0 or 7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.monthContainer = scheduler.inherit(scheduler.baseContainer,
{
    // Constructor
    constructor: function ()
    {
        scheduler.monthContainer.superclass.constructor.call(this, 1, 12);
        this.currentYear = 0;
        this.currentDay = 1;
    },

    // Methods
    toString: function ()
    {
        return scheduler.monthContainer.superclass.toString.call(this) + "\t";
    },

    next: function(presentDay, presentMonth, presentYear, nextDay, dayContainer, weekdayContainer)
    {
        this.goOver = false;
        this.currentYear = presentYear;

        var dres = dayContainer.next(presentDay, presentMonth, presentYear, nextDay);
        var wdres = weekdayContainer.next(presentDay, presentMonth, presentYear, nextDay);

        if (this.nextHash && this.nextHash.length > 0)
        {
            var curMonth = 0;

            if ((dres && !wdres) || 
            (dres && wdres && dayContainer.currentMonth < weekdayContainer.currentMonth) ||
            (dres && wdres && dayContainer.currentMonth == weekdayContainer.currentMonth && 
            dayContainer.currentValue <= weekdayContainer.currentValue))
            {
                curMonth = dayContainer.currentMonth;
                this.currentYear = dayContainer.currentYear;
                this.currentDay = dayContainer.currentValue;
            }
            else if ((!dres && wdres) || 
            (dres && wdres && dayContainer.currentMonth > weekdayContainer.currentMonth) ||
            (dres && wdres && dayContainer.currentMonth == weekdayContainer.currentMonth && 
            dayContainer.currentValue >= weekdayContainer.currentValue))
            {
                curMonth = weekdayContainer.currentMonth;
                this.currentYear = weekdayContainer.currentYear;
                this.currentDay = weekdayContainer.currentValue;
            }

            if (scheduler.isDefined(this.nextHash[curMonth]))
            {
                if (this.nextHash[curMonth] > curMonth)
                {
                    return this.next(-1, this.nextHash[curMonth], this.currentYear, false, dayContainer, weekdayContainer);
                }
                this.currentValue = this.nextHash[curMonth];
                return true;
            }
            this.currentYear = this.currentYear + 1;
            return this.next(-1, this.getFirst(), this.currentYear, false, dayContainer, weekdayContainer);
        }
        return false;
    },

    previous: function(presentDay, presentMonth, presentYear, nextDay, dayContainer, weekdayContainer)
    {
        this.goOver = false;
        this.currentYear = presentYear;

        var dres = dayContainer.previous(presentDay, presentMonth, presentYear, nextDay);
        var wdres = weekdayContainer.previous(presentDay, presentMonth, presentYear, nextDay);
        
        if (this.previousHash && this.previousHash.length > 0)
        {
            var curMonth = 0;

            if ((dres && !wdres) || 
            (dres && wdres && 
            dayContainer.currentMonth < weekdayContainer.currentMonth) ||
            (dres && wdres && 
            dayContainer.currentMonth == weekdayContainer.currentMonth && 
            dayContainer.currentValue >= weekdayContainer.currentValue))
            {
                curMonth = dayContainer.currentMonth;
                this.currentYear = dayContainer.currentYear;
                this.currentDay = dayContainer.currentValue;
            }
            else if ((!dres && wdres) || 
            (dres && wdres && dayContainer.currentMonth > weekdayContainer.currentMonth) ||
            (dres && wdres && dayContainer.currentMonth == weekdayContainer.currentMonth && 
            dayContainer.currentValue <= weekdayContainer.currentValue))
            {
                curMonth = weekdayContainer.currentMonth;
                this.currentYear = weekdayContainer.currentYear;
                this.currentDay = weekdayContainer.currentValue;
            }

            if (scheduler.isDefined(this.previousHash[curMonth]))
            {
                if (this.previousHash[curMonth] > curMonth)
                {
                    return this.previous(-1, this.previousHash[curMonth], this.currentYear, false, dayContainer, weekdayContainer);
                }
                this.currentValue = this.previousHash[curMonth];
                return true;
            }
            this.currentYear = this.currentYear - 1;
            return this.previous(-1, this.getLast(), this.currentYear, false, dayContainer, weekdayContainer);
        }
        return false;
    },

    add: function(month)
    {
        if (month != null && /^([\d]{1,2})$/.test(month))
        {
            if ((1 * month) >= this.minBound && this.maxBound >= (1 * month))
            {
                return scheduler.monthContainer.superclass.add.call(this, month);
            }
        }
        throw new InvalidArgumentException();
    },

    toHumanString: function()
    {
        return scheduler.monthContainer.superclass.toHumanString.call(this, "month");
    },

    suffix: function(numeric, word)
    {
        return Date.monthNames[numeric - 1];
    },

    prefix: function(word)
    {
        return ((word == "") ? " from " : String.format("{0} from ", word));
    },

    // Attributes
    currentYear: null,
    currentDay: null
});