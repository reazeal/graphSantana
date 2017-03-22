/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23) 
|  |  .---------- day of month (1 - 31)                     <-this
|  |  |  .------- month (1 - 12) 
|  |  |  |  .---- day of week (0 - 7) (Sunday=0,7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.dayContainer = scheduler.inherit(scheduler.baseContainer,
{
    // Constructor
    constructor: function ()
    {
        scheduler.dayContainer.superclass.constructor.call(this, 1, 31);
        this.currentMonth = 0;
        this.currentYear = 0;
    },

    // Methods
    toString: function ()
    {
        return scheduler.dayContainer.superclass.toString.call(this) + "\t";
    },

    next: function(presentDay, presentMonth, presentYear, nextDay)
    {
        this.currentMonth = presentMonth;
        this.currentYear = presentYear;

        if (this.nextHash && this.nextHash.length > 0)
        {   
            if (1 * presentDay == -1)
            {
                presentDay = this.getFirst();
            }
            var pDay = (1 * presentDay);
            if (nextDay == true)
            {
                pDay = pDay + 1;
            }
            
            var daysOfMonth = (new Date((new Date()).getFullYear(), presentMonth - 1, 1, 0, 0, 0, 0)).getDaysInMonth();
            if (scheduler.isDefined(this.nextHash[pDay]) && this.nextHash[pDay] <= daysOfMonth)
            {
                this.currentValue = this.nextHash[pDay];
                return true;
            }
            this.currentYear = ((this.currentMonth + 1 > 12) ? this.currentYear + 1 : this.currentYear);
            this.currentMonth = ((this.currentMonth + 1 > 12) ? 1 : this.currentMonth + 1);
            return this.next(this.getFirst(), this.currentMonth, this.currentYear, false);
        }
        return false;
    },

    previous: function(presentDay, presentMonth, presentYear, nextDay)
    {
        this.currentYear = presentYear;
        this.currentMonth = presentMonth;

        if (this.previousHash && this.previousHash.length > 0)
        {
            if (1 * presentDay == -1)
            {
                presentDay = this.getLast(this.currentMonth);
            }
           var pDay = (1 * presentDay);
            if (nextDay == true)
            {
                pDay = pDay - 1;
            }

            var daysOfMonth = (new Date((new Date()).getFullYear(), presentMonth - 1, 1, 0, 0, 0, 0)).getDaysInMonth();
            if (scheduler.isDefined(this.previousHash[pDay]) && this.previousHash[pDay] <= daysOfMonth)
            {
                this.currentValue = this.previousHash[pDay];
                return true;
            }
            this.currentYear = ((this.currentMonth - 1 < 1) ? this.currentYear - 1 : this.currentYear);
            this.currentMonth = ((this.currentMonth - 1 < 1) ? 1 : this.currentMonth - 1);
            return this.previous(this.getLast(this.currentMonth), this.currentMonth, this.currentYear, false);
        }
        return false;
    },

    add: function(day)
    {
        if (day != null && /^([\d]{1,2})$/.test(day))
        {
            if ((1 * day) >= this.minBound && (1 * day) <= this.maxBound)
            {
                return scheduler.dayContainer.superclass.add.call(this, day);
            }
        }
        throw new InvalidArgumentException();
    },

    getLast: function(presentMonth)
    {
        var daysOfMonth = (new Date((new Date()).getFullYear(), presentMonth - 1, 1, 0, 0, 0, 0)).getDaysInMonth();
        if (this.getLength() > 0 &&
        this.container[this.getLength() - 1] <= daysOfMonth)
        {
            return this.container[this.getLength() - 1];
        }
        return daysOfMonth;
    },

    toHumanString: function()
    {
        return scheduler.dayContainer.superclass.toHumanString.call(this, "day");
    },

    suffix: function(numeric, word)
    {
        if ((numeric * 1) == 2)
        {
            return numeric + "nd" + " " + word;
        }
        return numeric + "th" + " " + word;
    },

    prefix: function(word)
    {
        return ((word == "") ? "on " : String.format("{0} at ", word));
    },

    // Attributes
    currentMonth: null,
    currentYear: null
});