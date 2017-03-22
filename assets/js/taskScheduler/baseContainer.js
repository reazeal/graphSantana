/*
a typical cron entry has either wildcards (*) or an integer: 
.---------------- minute (0 - 59)  
|  .------------- hour (0 - 23) 
|  |  .---------- day of month (1 - 31) 
|  |  |  .------- month (1 - 12) 
|  |  |  |  .---- day of week (0 - 7) (Sunday=0 or 7) 
|  |  |  |  | *  *  *  *  *
*/

scheduler.baseContainer = scheduler.inherit(function () { },
{
    // Constructor
    constructor: function (begin, end)
    {
        scheduler.baseContainer.superclass.constructor.call(this);

        this.container = new Array();

        this.minBound = begin;
        this.maxBound = end;

        this.currentValue = begin;

        this.goOver = false;
    },

    // Methods
    fromString: function (cronstring)
    {
        if (cronstring != null)
        {
            var items = cronstring.match(/^([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]*$/);
            if (items != null)
            {
                return this.parseAndAdd(items[1]);
            }
        }
        throw new InvalidArgumentException();
    },

    toString: function ()
    {
        if (this.getLength() > 0)
        {
            var step = this.getStep(true);
            var start = this.startFrom();
            var end = this.endTo();

            if (step >= 1)
            {
                return ((start != -1) ? String.format("{0}-{1}/{2}", start, end, step) : ((step > 1) ? String.format("*/{0}", step) : "*"));
            }
            else
            {
                return this.container.join(",");
            }
        }
        return "*"; // * it means 'any', by default
    },

    initialize: function ()
    {
        var i = this.minBound;
        for (var j = 0; j < this.getLength() ; ++j)
        {
            for (; i <= this.maxBound; ++i)
            {
                if (i <= this.container[j])
                {
                    this.nextHash[i] = this.container[j];
                }
                else
                {
                    break;
                }
            }
        }
        //---------------------------------------------
        i = this.maxBound;
        for (var j = this.getLength() - 1; j > -1; j--)
        {
            for (; i >= this.minBound; i--)
            {
                if (i >= this.container[j])
                {
                    this.previousHash[i] = this.container[j];
                }
                else
                {
                    break;
                }
            }
        }
    },

    add: function (elem)
    {
        this.nextHash = new Array();
        this.previousHash = new Array();

        if (/^([\d]{1,2})$/.test(elem))
        {
            var newelem = 1 * elem;
            if (this.container.every(scheduler.isNumeric) &&
                this.container.indexOf(newelem, 0) == -1)
            {
                this.container.push(1 * newelem);
                return true;
            }
            return true;
        }
        throw new InvalidArgumentException();
    },

    removeAt: function (index)
    {
        if (/^[\d]+$/.test(index) && this.getLength() > (1 * index))
        {
            var val = this.container[(1 * index)];
            if (val != null)
            {
                this.remove(val);
            }
        }
    },

    remove: function (elem)
    {
        this.nextHash = new Array();
        this.previousHash = new Array();

        this.container.remove((1 * elem));
    },

    erase: function ()
    {
        if (scheduler.isDefined(this.container) && this.container != null)
        {
            this.container.clear();
        }
        if (scheduler.isDefined(this.nextHash) && this.nextHash != null)
        {
            this.nextHash.clear();
        }
        if (scheduler.isDefined(this.previousHash) && this.previousHash != null)
        {
            this.previousHash.clear();
        }
        this.currentValue = this.minBound;
        this.goOver = false;
    },

    getFirst: function ()
    {
        if (this.getLength() > 0)
        {
            return this.container[0];
        }
        return this.minBound;
    },

    getLast: function ()
    {
        if (this.getLength() > 0)
        {
            return this.container[this.getLength() - 1];
        }
        return this.minBound;
    },

    parseAndAdd: function (cronStrElem)
    {
        if (cronStrElem != null)
        {
            var match = cronStrElem.match(/([\d,\-\*]+)(?:(?:[\/])(\d{1,2}|\*{1}))*/);
            if (match.length > 0)
            {
                var range = match[1];
                var step = scheduler.isEmpty(match[2]) ? 0 : match[2];
                if (range.indexOf(',', 0) !== -1)
                {
                    range = cronStrElem.split(',');
                    for (var i = 0; i < range.length; ++i)
                    {
                        if (range[i].indexOf('-', 0) != -1)
                        {
                            this.parseAndAdd(range[i]);
                        }
                        else
                        {
                            if (!this.add(range[i]))
                            {
                                throw new InvalidArgumentException();
                            }
                        }
                    }
                }
                else if (range === '*')
                {
                    if (!this.addRange(this.minBound, this.maxBound, (step === 0 ? 1 : step)))
                    {
                        throw new InvalidArgumentException();
                    }
                }
                else if (range.indexOf('-', 0) !== -1)
                {
                    var innerrange = range.split('-');
                    if (innerrange.length > 0 && ((1 * innerrange[0]) > 0 && ((1 * innerrange[0]) < (1 * innerrange[1]))))
                    {
                        var start = (innerrange[0] < this.minBound) ? this.minBound : innerrange[0];
                        var stop = (innerrange[1] > this.maxBound) ? this.maxBound : innerrange[1];
                        if (!this.addRange(start, stop, (step === 0 ? 1 : step)))
                        {
                            throw new InvalidArgumentException();
                        }
                    }
                    else
                    {
                        throw new InvalidArgumentException();
                    }
                }
                else if (range.match(/[\d]{1,2}/) && step === 0)
                {
                    if (!this.add(range))
                    {
                        throw new InvalidArgumentException();
                    }
                }
                else if (range.match(/[\d]{1,2}/) && step > 0)
                {
                    if (!this.addRange(range, this.maxBound, step))
                    {
                        throw new InvalidArgumentException();
                    }
                }
                else
                {
                    throw new InvalidArgumentException();
                }
                this.container.sort(function (a, b) { return a - b });
                return true;
            }
        }
        throw new InvalidArgumentException();
    },

    startFrom: function startFrom()
    {
        if (scheduler.isDefined(this.container) && this.getLength() > 0)
        {
            return (this.container[0] != this.minBound) ? this.container[0] : -1;
        }
        return -1;
    },

    endTo: function endTo()
    {
        if (scheduler.isDefined(this.container) && this.getLength() > 0)
        {
            return this.container[this.getLength() - 1];
        }
        return -1;
    },

    getStep: function (allowPart)
    {
        if (this.container && this.getLength() > 1)
        {
            var delta = this.container[1] - ((allowPart) ? this.container[0] : this.minBound);
            for (var i = 0; i < this.getLength() ; ++i)
            {
                if (i + 1 < this.getLength() &&
                this.container[i] + delta == this.container[i + 1])
                {
                    continue;
                }
                else if (i + 1 < this.getLength() &&
                this.container[i] + delta != this.container[i + 1])
                {
                    return 0;
                }
                else if (i + 1 == this.getLength())
                {
                    return delta;
                }
                else if (i + 1 < this.getLength())
                {
                    return 0;
                }
            }
            return 0;
        }
        return 0;
    },

    getLength : function()
    {
        return this.container ? this.container.length : 0;
    },
    
    //private methods
    addRange: function addRange(start, end, step)
    {
        for (var j = (1 * start); j <= (1 * end); j += (1 * step))
        {
            if (!this.add(j))
            {
                throw new InvalidArgumentException();
            }
        }
        return true;
    },

    pluralWord: function (numeric, word)
    {
        if (numeric > 1)
        {
            return numeric + " " + word + "s";
        }
        else if (numeric == 1)
        {
            return word;
        }
        else if (numeric == 0)
        {
            return "";
        }
    },

    pluralWordExt: function (numeric, word, isMinute)
    {
        if (numeric > 1)
        {
            if (isMinute && numeric <= 9)
            {
                return "0" + numeric + ((word !== "") ? " " + word + "s" : "");
            }
            else
            {
                return numeric + ((word !== "") ? " " + word + "s" : "");
            }
        }
        else if (numeric == 1)
        {
            if (isMinute)
            {
                return "0" + numeric + ((word !== "") ? " " + word : "");
            }
            else
            {
                return numeric + ((word !== "") ? " " + word : "");
            }
        }
        else if (numeric == 0 && isMinute)
        {
            return "00" + ((word !== "") ? " " + word + "s" : "");
        }
        else if (numeric == 0 && !isMinute)
        {
            return "0" + ((word !== "") ? " " + word + "s" : "");
        }
    },

    toHumanString: function (word)
    {
        var cntrStep = this.getStep(true);
        if (this.container)
        {
            var humanStr = "";
            if (cntrStep > 0)
            {
                var startfrom = this.startFrom();
                humanStr = "every " + this.pluralWord(cntrStep, word) +
                ((startfrom != -1) ? " " + this.prefix("starting") + this.suffix(startfrom, word) : "");
            }
            else if (cntrStep == 0 && this.getLength() == 1)
            {
                humanStr = this.prefix("") + this.suffix(this.container[0], word);
            }
            else if (cntrStep == 0 && this.getLength() > 1)
            {
                var words = this.prefix("");
                for (var i = 0; i < this.getLength() ; ++i)
                {
                    words = words + "" + this.container[i] + "" + ((i + 1 < this.getLength()) ? ", " : "");
                }
                humanStr = words + " " + ((this.getLength() > 1) ? word + "s" : word);
            }
            return humanStr;
        }
        return "";
    },

    suffix: function (numeric, word)
    {
        return numeric + " " + word;
    },

    prefix: function (word)
    {
        return ", ";
    },

    // Attributes
    container: null,
    nextHash: null,
    previousHash: null,
    minBound: null,
    maxBound: null,
    currentValue: null,
    goOver: null

});