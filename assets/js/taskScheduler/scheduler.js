
scheduler.scheduler = (function ()
{
    return function ()
    {
        // Methods
        this.fromString = function (cronstring)
        {
            this.erase();
            if (cronstring != null)
            {
                var items = cronstring.match(/^([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]+([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]+([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]+([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]+([\d,-]+|(?:\*|(?:\d{1,2}|\d{1,2}-\d{1,2}))\/\d{1,2}|\*{1})[ \n\t\b]*$/);
                if (items != null)
                {
                    if (!minuteContainer.fromString(items[1]))
                    {
                        throw new InvalidArgumentException();
                    }
                    if (!hourContainer.fromString(items[2]))
                    {
                        throw new InvalidArgumentException();
                    }
                    if (!monthContainer.fromString(items[4]))
                    {
                        throw new InvalidArgumentException();
                    }
                    if ( ( !(/^[\*]+$/.test(items[3])) && !(/^[\*]+$/.test(items[5])) ) || 
                    ( /^[\*]+$/.test(items[3]) && /^[\*]+$/.test(items[5]) ) ||
                    ( !(/^[\*]+$/.test(items[3])) && /^[\*]+$/.test(items[5]) ) )
                    {
                        if (!dayContainer.fromString(items[3]))
                        {
                            throw new InvalidArgumentException();
                        }
                    }
                    if ( ( !(/^[\*]+$/.test(items[3])) && !(/^[\*]+$/.test(items[5])) ) || 
                    ( /^[\*]+$/.test(items[3]) && /^[\*]+$/.test(items[5]) ) ||
                    ( /^[\*]+$/.test(items[3]) && !(/^[\*]+$/.test(items[5])) ) )
                    {
                        if (!weekDayContainer.fromString(items[5]))
                        {
                            throw new InvalidArgumentException();
                        }
                    }
                    return true;
                }
            }
            throw new InvalidArgumentException();
        };

        this.isEmpty = function()
        {
            if (!minuteContainer.getLength() ||
            !hourContainer.getLength() ||
            (!dayContainer.getLength() && !weekDayContainer.getLength()) ||
            !monthContainer.getLength())
            {
                return true;
            }
            return false;
        };

        this.toString = function ()
        {
            return minuteContainer.toString() + hourContainer.toString() + dayContainer.toString() + 
                monthContainer.toString() + weekDayContainer.toString();
        };

        this.toHumanString = function(startingDate)
        {
            if (this.isEmpty())
            {
                return '';
            }
            else if (minuteContainer.getLength() == 60 &&
                    hourContainer.getLength() == 24 &&
                    dayContainer.getLength() >= 28 &&
                    monthContainer.getLength() == 12 &&
                    weekDayContainer.getLength() == 7)
            {
                return "Occurs continously.";
            }
            else if (scheduler.isEmpty(startingDate))
            {
                return "Occurs " + hourContainer.toHumanString(minuteContainer.getFirst()) + ", " +
                    ((dayContainer.toHumanString() == weekDayContainer.toHumanString()) ? weekDayContainer.toHumanString() : dayContainer.toHumanString() + ((dayContainer.toHumanString() !== "" && weekDayContainer.toHumanString() !== "") ? " and " : "") + weekDayContainer.toHumanString()) + ", " +
                    monthContainer.toHumanString() + ". ";
            }

            return "Occurs " + hourContainer.toHumanString(minuteContainer.getFirst()) + ", " +
            ((dayContainer.toHumanString() == weekDayContainer.toHumanString()) ? weekDayContainer.toHumanString() : dayContainer.toHumanString() + ((dayContainer.toHumanString() !== "" && weekDayContainer.toHumanString() !== "") ? " and " : "" ) + weekDayContainer.toHumanString()) + ", " + 
            monthContainer.toHumanString() + ". " + "Effective: " + ((scheduler.isDefined(startingDate) && startingDate != null && startingDate instanceof Date) ? startingDate.toDateString() : initialDate.toDateString());
        };

        this.setCurrentTime = function(minute, hour, day, month, year)
        {
            if (minute != null && hour != null && day != null && month != null && year != null)
            {
                var date = new Date(year, (1 * month) - 1, day, hour, minute, 0, 0);
                return this.setCurrentTimeExt(date);
            }
            throw new InvalidArgumentException();
        };

        this.setCurrentTimeExt = function(dateTime)
        {
            if (this.isEmpty())
            {
                return false;
            }

            minuteContainer.initialize();
            hourContainer.initialize();
            dayContainer.initialize();
            weekDayContainer.initialize();
            monthContainer.initialize();

            if (dateTime != null && dateTime instanceof Date)
            {
                minute = dateTime.getMinutes();
                hour = dateTime.getHours(); 
                day = dateTime.getDate();
                month = dateTime.getMonth() + 1;
                year = dateTime.getFullYear();

                initialDate = dateTime;

                return true;
            }
            else if (dateTime != null && dateTime instanceof String)
            {
                var date = new Date(dateTime);
                return this.setCurrentTimeExt(date);
            }
            throw new InvalidArgumentException();
        };

        this.next = function()
        {
            if (minuteContainer.next(minute))
            {   
                minute = minuteContainer.currentValue;
                if (hourContainer.next(hour, minuteContainer.goOver))
                {
                    hour = hourContainer.currentValue;

                    if (hourContainer.goOver == true)
                    {
                        minute = minuteContainer.getFirst();
                    }
                    if (monthContainer.next(day, month, year, hourContainer.goOver, dayContainer, weekDayContainer))
                    {
                        day = monthContainer.currentDay;
                        month = monthContainer.currentValue;
                        year = monthContainer.currentYear;
                    }
                    else
                    {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        };

        this.previous = function()
        {
            if (minuteContainer.previous(minute))
            {
                minute = minuteContainer.currentValue;
                if (hourContainer.previous(hour, minuteContainer.goOver))
                {
                    hour = hourContainer.currentValue;
                    if (hourContainer.goOver == true)
                    {
                        minute = minuteContainer.getLast();
                    }
                    if (monthContainer.previous(day, month, year, hourContainer.goOver, dayContainer, weekDayContainer))
                    {
                        day = monthContainer.currentDay;
                        month = monthContainer.currentValue;
                        year = monthContainer.currentYear;
                    }
                    else
                    {
                        return false;
                    }
                    return true;
                }
            }
            return false;
        };

        /* set maxSyncLoadEl to -1 to have traditional loop */
        this.getAllNextTill = function (endDate, callback, maxSyncLoadEl)
        {
            var _allDates = Array();
            var _maxSyncLoadEl = typeof maxSyncLoadEl != 'undefined' && scheduler.isNumber(maxSyncLoadEl) ? maxSyncLoadEl : maxSyncLoadElDef;
            var _callback = callback;
            var _endDate = endDate;
            var _syncLoadedEl = 0;

            if (_endDate != null && _endDate instanceof Date)
            {
                var scope = this;
                (function loop()
                {
                    try
                    {
                        while(_maxSyncLoadEl == -1 || _syncLoadedEl <= _maxSyncLoadEl)
                        {
                            if (scope.next())
                            {
                                var curDate = scope.getDateStamp();
                                if (_endDate > curDate)
                                {
                                    _allDates.push(curDate);
                                }
                                else
                                {
                                    if (callback)
                                    {
                                        callback(_allDates);
                                    }
                                    return;
                                }
                            }

                            _syncLoadedEl++;

                        }

                        _syncLoadedEl = 0;
                        setTimeout(loop, 1);
                    }
                    catch (e)
                    {
                        throw e;
                    }
                })();
            }
            else
            {
                throw new InvalidArgumentException();
            }
        };

        /* set maxSyncLoadEl to -1 to have traditional loop */
        this.getAllPreviousTill = function (startDate, callback, maxSyncLoadEl)
        {
            var _allDates = Array();
            var _maxSyncLoadEl = typeof maxSyncLoadEl != 'undefined' && scheduler.isNumber(maxSyncLoadEl) ? maxSyncLoadEl : maxSyncLoadElDef;
            var _callback = callback;
            var _startDate = startDate;
            var _syncLoadedEl = 0;

            if (_startDate != null && _startDate instanceof Date)
            {
                var scope = this;
                (function loop()
                {
                    try
                    {
                        while(_maxSyncLoadEl == -1 || _syncLoadedEl <= _maxSyncLoadEl)
                        {
                            if (scope.previous())
                            {
                                var curDate = scope.getDateStamp();
                                if (_startDate < curDate)
                                {
                                    _allDates.push(curDate);
                                }
                                else
                                {
                                    if (callback)
                                    {
                                        callback(_allDates);
                                    }
                                    return;
                                }
                            }

                            _syncLoadedEl++;
                        }

                        _syncLoadedEl = 0;
                        setTimeout(loop, 1);
                    }
                    catch (e)
                    {
                        throw e;
                    }
                })();
            }
            else
            {
                throw new InvalidArgumentException();
            }
        };

        this.getStringDateStamp = function()
        {
            return dateNumbersToString(month) + "/" + dateNumbersToString(day) + "/" + year + " (" + dateNumbersToString(hour) + ":" + dateNumbersToString(minute) + ")";
        };

        this.getDateStamp = function()
        {
            var date = new Date(year, month - 1, day, hour, minute, 0, 0);
            return date;
        };

        //methods to fill in date, to form cron string
        this.addMinute = function(minute)
        {
            return minuteContainer.add(minute);
        };

        this.removeMinute = function(minute)
        {
            return minuteContainer.remove(minute);
        };

        this.addHour = function(hour)
        {
            return hourContainer.add(hour);
        };

        this.removeHour = function(hour)
        {
            return hourContainer.remove(hour);
        };

        this.addDay = function(day)
        {
            return dayContainer.add(day);
        };

        this.removeDay = function(day)
        {
            return dayContainer.remove(day);
        };

        this.addMonth = function(month)
        {
            return monthContainer.add(month);
        };

        this.removeMonth = function(month)
        {
            return monthContainer.remove(month);
        };

        this.addWeekDay = function(weekDay)
        {
            return weekDayContainer.add(weekDay);
        };

        this.removeWeekDay = function(weekDay)
        {
            return weekDayContainer.remove(weekDay);
        };

        this.erase = function ()
        {
            if (scheduler.isDefined(minuteContainer) && minuteContainer != null)
            {
                minuteContainer.erase();
            }
            if (scheduler.isDefined(hourContainer) && hourContainer != null)
            {
                hourContainer.erase();
            }
            if (scheduler.isDefined(dayContainer) && dayContainer != null)
            {
                dayContainer.erase();
            }
            if (scheduler.isDefined(monthContainer) && monthContainer != null)
            {
                monthContainer.erase();
            }
            if (scheduler.isDefined(weekDayContainer) && weekDayContainer != null)
            {
                weekDayContainer.erase();
            }

            this.setCurrentTimeExt(new Date());
        };

        //private methods
        function dateNumbersToString(num)
        {
            return (num > 9 ? '' + num : '0' + num);
        };

        // Attributes
        var initialDate = null,

        //date containers
        minuteContainer = null,
        hourContainer = null,
        dayContainer = null,
        monthContainer = null,
        weekDayContainer = null,

        //next date
        minute = null,
        hour = null,
        day = null,
        month = null,
        year = null;

        var maxSyncLoadElDef = 100;

        // Constructor
        (function constructor()
        {
            minuteContainer = new scheduler.minuteContainer();
            hourContainer = new scheduler.hourContainer();
            dayContainer = new scheduler.dayContainer();
            monthContainer = new scheduler.monthContainer();
            weekDayContainer = new scheduler.weekContainer();

            this.setCurrentTimeExt(new Date());
        }).call(this);
    }
})();