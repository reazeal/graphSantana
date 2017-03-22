/* set maxSyncLoadEl to -1 to have traditional loop */
this.getAllNextTill = function (endDate, callback, maxSyncLoadEl)
{
    var _allDates = Array();
    var _maxSyncLoadEl = typeof maxSyncLoadEl != 'undefined' && 
    	scheduler.isNumber(maxSyncLoadEl) ? maxSyncLoadEl : maxSyncLoadElDef;
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
                while(_maxSyncLoadEl == -1 || _syncLoadedEl &lt;= _maxSyncLoadEl)
                {
                    if (scope.previous())
                    {
                        var curDate = scope.getDateStamp();
                        if (_startDate &lt; curDate)
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
}
//

this.start = function ()
{
    _isStarted = true;
    continuouslyRun(true);
};

function continuouslyRun(skip)
{
    if (_isStarted)
    {
        if (!skip)
        {
            runOnce();
        }

        //schedule next time of running
        var currDate = new Date();
        _scheduler.setCurrentTimeExt(currDate);
        if (_scheduler.next())
        {
            var nextDate = _scheduler.getDateStamp();
            var timeout = nextDate.getTime() - currDate.getTime();
            _timerId = setTimeout(continuouslyRun, timeout);
        }
    }
};
function runOnce()
{
    _isRunning = true;

    if (_action)
    {
        if (!_args)
        {
            _action(scope);
        }
        else
        {
            _action(scope, _args);
        }
    }

    _isRunning = false;
};
//