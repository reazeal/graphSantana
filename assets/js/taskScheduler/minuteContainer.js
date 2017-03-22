/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)                     <-this 
|  .------------- hour (0 - 23) 
|  |  .---------- day of month (1 - 31) 
|  |  |  .------- month (1 - 12) 
|  |  |  |  .---- day of week (0 - 7) (Sunday=0,7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.minuteContainer = scheduler.inherit(scheduler.baseContainer,
{
    // Constructor
    constructor: function ()
    {
        scheduler.minuteContainer.superclass.constructor.call(this, 0, 59);
    },

    // Methods
    toString: function ()
    {
        return scheduler.minuteContainer.superclass.toString.call(this) + "\t";
    },

    next: function(presentMinute)
    {
        this.goOver = false;
        if (scheduler.isDefined(this.nextHash) && this.nextHash != null && this.nextHash.length > 0)
        {
            var pMinute = (1 * presentMinute) + 1;
            if (scheduler.isDefined(this.nextHash[pMinute]))
            {
                this.currentValue = this.nextHash[pMinute];
                return true;
            }
            this.goOver = true;
            this.currentValue = this.getFirst();
            return true;
        }
        return false;
    },

    previous: function(presentMinute)
    {
        this.goOver = false;

        if (this.nextHash && this.previousHash.length > 0)
        {
            var pMinute = (1 * presentMinute) - 1;
            if (scheduler.isDefined(this.previousHash[pMinute]))
            {
                this.currentValue = this.previousHash[pMinute];
                return true;
            }
            this.goOver = true;
            this.currentValue = this.getLast();
            return true;
        }
        return false;
    },

    add: function(minute)
    {
        if (minute != null && /^([\d]{1,2})$/.test(minute))
        {
            if ((1 * minute) >= this.minBound && this.maxBound >= (1 * minute))
            {
                return scheduler.minuteContainer.superclass.add.call(this, minute);
            }
        }
        throw new InvalidArgumentException();
    },

    toHumanString: function()
    {
        return scheduler.minuteContainer.superclass.toHumanString.call(this, "minute");
    }

    // Attributes

});