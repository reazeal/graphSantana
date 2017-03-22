
/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23)                    <-this 
|  |  .---------- day of month (1 - 31) 
|  |  |  .------- month (1 - 12) 
|  |  |  |  .---- day of week (0 - 7) (Sunday=0,7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.hourContainer = scheduler.inherit(scheduler.baseContainer,
{
    // Constructor
    constructor: function ()
    {
        scheduler.hourContainer.superclass.constructor.call(this, 0, 23);
    },

    // Methods
    toString: function ()
    {
        return scheduler.hourContainer.superclass.toString.call(this) + "\t";
    },

    next: function(presentHour, nextHour)
    {
        this.goOver = false;

        if (this.nextHash && this.nextHash.length > 0)
        {
            var pHour = (1 * presentHour);
            if (nextHour == true)
            {
                pHour = pHour + 1;
            }

            if (scheduler.isDefined(this.nextHash[pHour]))
            {
                this.currentValue = this.nextHash[pHour];
                return true;
            }
            this.goOver = true;
            this.currentValue = this.getFirst();
            return true;
        }
        return false;
    },

    previous: function(presentHour, nextHour)
    {
        this.goOver = false;

        if (this.previousHash && this.previousHash.length > 0)
        {
            var pHour = (1 * presentHour);
            if (nextHour == true)
            {
                pHour = pHour - 1;
            }
            if (scheduler.isDefined(this.previousHash[pHour]))
            {
                this.currentValue = this.previousHash[pHour];
                return true;
            }
            this.goOver = true;
            this.currentValue = this.getLast();
            return true;
        }
        return false;
    },

    add: function(hour)
    {
        if (!scheduler.isEmpty(hour) && /^([\d]{1,2})$/.test(hour))
        {
            if ((1 * hour) >= this.minBound && this.maxBound >= (1 * hour))
            {
                return scheduler.hourContainer.superclass.add.call(this, hour);
            }
        }
        throw new InvalidArgumentException();
    },

    toHumanString: function(minute)
    {
        var cntrStep = this.getStep(true);
        if (this.container)
        {
            var humanStr = "";
            if (cntrStep > 0)
            {
                var startfrom = this.startFrom();
                humanStr = "every " + this.pluralWord(cntrStep, "hour") + 
                ( (startfrom != -1) ? " " + this.prefix("starting") + this.hourToString(startfrom) + ":" + this.minuteToString(minute) :  
                ((minute > 0) ? " " + this.prefix("") + this.pluralWordExt(minute, "minute", true) : "" ) );
            }
            else if (cntrStep == 0 && this.getLength() == 1)
            {
                humanStr = this.prefix("") + this.hourToString(this.container[0]) + ":" + this.minuteToString(minute);
            }
            else if (cntrStep == 0 && this.getLength() > 1)
            {
                var words = this.prefix("");
                for (var i = 0; i < this.getLength() ; ++i)
                {
                    words = words + "" + this.container[i] + "" + ((i + 1 < this.getLength()) ? ", " : "");
                }
                humanStr = words + " " + this.prefix("hours") + this.pluralWordExt(minute, "minute", true);
            }
            return humanStr;
        }
        return "";
    },

    hourToString: function(hour)
    {
        return (((hour * 1) < 10) ? String.format("0{0}", hour) : hour);
    },

    minuteToString: function(minute)
    {
        return (((minute * 1) < 10) ? String.format("0{0}", minute) : minute);
    },

    prefix: function(word)
    {
        return ((word == "") ? "at " : String.format("{0} at ", word));
    }

    // Attributes
});