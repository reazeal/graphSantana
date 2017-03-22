scheduler.taskManager = (function ()
{
    var _isStarted = false;

    var hashTable = new scheduler.hashTable();

    return function ()
    {
        this.addTask = function (task)
        {
            hashTable.add(task.getId(), task);
            if (_isStarted)
            {
                task.start();
            }
        };

        this.removeTask = function (task)
        {
            if (scheduler.isString(task))
            {
                task = this.getTask(task);
            }
            task.stop();
            hashTable.remove(task.getId());
        };

        this.getTask = function (id)
        {
            return hashTable.getById(id);
        };

        this.runNowTask = function (id)
        {
            var task = hashTable.getById(id);
            if (!task)
            {
                throw new InvalidArgumentException();
            }
            task.run();
        };

        this.start = function ()
        {
            _isStarted = true;
            hashTable.foreach(function (task)
            {
                if (!task.isStarted())
                {
                    task.start();
                }
            }, this);
        };

        this.stop = function ()
        {
            _isStarted = false;
            hashTable.foreach(function (task)
            {
                if (task.isStarted())
                {
                    task.stop();
                }
            }, this);
        };

        this.enumerate = function (callback)
        {
            hashTable.foreach(function (task)
            {
                callback(task);
            }, this);
        };

    }

})();