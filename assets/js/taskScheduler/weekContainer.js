/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23) 
|  |  .---------- day of month (1 - 31) 
|  |  |  .------- month (1 - 12) 
|  |  |  |  .---- day of week (0 - 7) (Sunday=0 or 7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.weekContainer = scheduler.inherit(scheduler.baseContainer,
{
    // Constructor
    constructor: function ()
    {
        scheduler.weekContainer.superclass.constructor.call(this, 0, 7);
        this.currentMonth = 0;
        this.currentYear = 0;
    },

    // Methods
    toString: function ()
    {
        return scheduler.weekContainer.superclass.toString.call(this);
    },

    next: function(day, month, year, nextDay)
    {
        this.currentMonth = month;
        this.currentYear = year;

        if (this.nextHash && this.nextHash.length > 0)
        {
            if (1 * day == -1)
            {
                day = 1;
            }

            var date = new Date(year, month - 1, day, 0, 0, 0, 0);
            if (nextDay == true)
            {
               date.setDate(date.getDate() + 1);
            }

            if (scheduler.isDefined(this.nextHash[date.getDay()]))
            {
                date.setDate(date.getDate() + (this.nextHash[date.getDay()] -  date.getDay()));
                if (month - 1 < date.getMonth() || year < date.getFullYear())
                {
                    this.currentYear = ((this.currentMonth + 1 > 12) ? this.currentYear + 1 : this.currentYear);
                    this.currentMonth = ((this.currentMonth + 1 > 12) ? 1 : this.currentMonth + 1);
                }
                this.currentValue = date.getDate();
                return true;
            }
            else
            {
                var delta = (7 - date.getDay()) + this.getFirst();
                date.setDate(date.getDate() + delta);
                if ((month - 1) < date.getMonth() || year < date.getFullYear())
                {
                    this.currentYear = ((this.currentMonth + 1 > 12) ? this.currentYear + 1 : this.currentYear);
                    this.currentMonth = ((this.currentMonth + 1 > 12) ? 1 : this.currentMonth + 1);
                }
                this.currentValue = date.getDate();
                return true;
            }
        }
        return false;
    },

    previous: function(day, month, year, nextDay)
    {
        this.currentMonth = month;
        this.currentYear = year;

        if (this.previousHash && this.previousHash.length > 0)
        {
            if (1 * day == -1)
            {
                day = (new Date(year, month - 1, 1, 0, 0, 0, 0)).getDaysInMonth();
            }

            var date = new Date(year, month, day, 0, 0, 0, 0);
            if (nextDay == true)
            {
               date.setDate(date.getDate() - 1);
            }

            if (scheduler.isDefined(this.previousHash[date.getDay()]))
            {
                date.setDate(date.getDate() - (date.getDay() - this.previousHash[date.getDay()]));
                if (month - 1 > date.getMonth() || year > date.getFullYear())
                {
                    this.currentYear = ((this.currentMonth - 1 < 1) ? this.currentYear - 1 : this.currentYear);
                    this.currentMonth = ((this.currentMonth - 1 < 1) ? 1 : this.currentMonth - 1);
                }
                this.currentValue = date.getDate();
                return true;
            }
            else
            {
                var delta = 7 - (this.getFirst() - date.getDay());
                date.setDate(date.getDate() - delta);
                if (month - 1 < date.getMonth() || year < date.getFullYear())
                {
                    this.currentYear = ((this.currentMonth - 1 < 1) ? this.currentYear - 1 : this.currentYear);
                    this.currentMonth = ((this.currentMonth - 1 < 1) ? 1 : this.currentMonth - 1);
                }
                this.currentValue = date.getDate();
                return true;
            }
        }
        return false;
    },

    add: function(weekday)
    {
        if (weekday != null && /^([\d]{1,2})$/.test(weekday))
        {
            if ((1 * weekday) >= this.minBound && (1 * weekday) <= this.maxBound)
            {
                if ((1 * weekday) == this.maxBound)
                {
                    weekday = 0;
                }
                return scheduler.weekContainer.superclass.add.call(this, weekday);
            }
        }
        throw new InvalidArgumentException();
    },

    toHumanString: function()
    {
        if (this.getLength())
        {
            var humanstring = "every ";
            if (this.getLength() == 7)
            {
                humanstring = humanstring + "day";
            }
            else if (this.getLength() == 5 &&
            this.container[0] == 1 && this.container[4] == 5)
            {
                humanstring = humanstring + "weekday";
            }
            else
            {
                for (var i = 0; i < this.getLength() ; ++i)
                {
                    humanstring = humanstring + "" + Date.dayNames[this.container[i]] + "" + ((i + 1 < this.getLength()) ? ", " : "");
                }
            }
            return humanstring;
        }
        return "";
    },

    // Attributes
    currentMonth: null,
    currentYear: null
});