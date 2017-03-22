scheduler.task = (function ()
{
    return function (schedule, action, args)
    {
        var scope = this;

        var _id = null;
        var _timerId = null;

        var _action = null;
        var _args = null;

        var _isRunning = false;
        var _isStarted = false;

        var _scheduler = null;

        //constructor
        (function constructor(schedule, action, args)
        {
            if (!schedule || typeof action !== 'function')
            {
                throw new InvalidArgumentException();
            };

            if (scheduler.isString(schedule))
            {
                _scheduler = new scheduler.scheduler();
                _scheduler.fromString(schedule);
            }
            else
            {
                _scheduler = schedule;
            }

            _action = action;
            _args = args;

            _id = scheduler.uid(32);

        })(schedule, action, args);

        this.getId = function ()
        {
            return _id;
        };

        this.getScheduler = function ()
        {
            return _scheduler;
        };

        this.run = function ()
        {
            runOnce();
        };

        this.start = function ()
        {
            _isStarted = true;
            continuouslyRun(true);
        };

        this.stop = function ()
        {
            _isStarted = false;
            clearTimeout(_timerId);
        };

        this.isStarted = function ()
        {
            return _isStarted;
        };

        this.isRunning = function ()
        {
            return _isRunning;
        };

        //private methods
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
    }

})();