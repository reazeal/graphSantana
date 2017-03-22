
scheduler.scheduleTest = (function ()
{
    return function ()
    {
        this.testCase1 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("*/5  2/3   *   *   *");
            var tostr = cron.toString();

            cron.setCurrentTime(58, 11, 12, 8, 2015);
            var humstr = cron.toHumanString();

            cron.next();
            var timestamp = cron.getStringDateStamp();

            cron.previous();
            timestamp = cron.getStringDateStamp();

            for (var i = 0; i < 100; i++)
            {
                cron.next();
                timestamp = cron.getStringDateStamp();
            }

            for (var i = 0; i < 100; i++)
            {
                cron.previous();
                timestamp = cron.getStringDateStamp();
            }
        };

        this.testCase2 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("20/5    2/3   1-2,4-7   *   *");
            try { cron.minuteContainer.add('w'); } catch (e) { }
            try { cron.minuteContainer.add(2); } catch (e) { }
            try { cron.minuteContainer.add(8); } catch (e) { }
            try { cron.dayContainer.add(2); } catch (e) { }
            try { cron.dayContainer.add('L'); } catch (e) { }
            try { cron.dayContainer.add('12'); } catch (e) { }
            try { cron.dayContainer.add('?'); } catch (e) { }
            try { cron.dayContainer.add('?'); } catch (e) { }
            try { cron.dayContainer.add('?'); } catch (e) { }
            try { cron.dayContainer.add('L'); } catch (e) { }
            try { cron.dayContainer.remove('12'); } catch (e) { }
            try { cron.dayContainer.removeAt('3'); } catch (e) { }
            try { cron.setCurrentTimeExt(new Date(2010, 4, 26, 10, 51, 0, 0)); } catch (e) { }

            var timestamp = '';
            for (var i = 0; i < 100; i++)
            {
                cron.next();
                timestamp = cron.getStringDateStamp();
            }

            for (var i = 0; i < 100; i++)
            {
                cron.previous();
                timestamp = cron.getStringDateStamp();
            }

        };

        this.testCase3 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("1,2,3,4,5    2/3   1-2,4-7   *   *");
            cron.setCurrentTimeExt(new Date(2010, 4, 26, 10, 51, 0, 0));

            var timestamp = '';
            for (var i = 0; i < 100; i++)
            {
                cron.next();
                timestamp = cron.getStringDateStamp();
            }

            for (var i = 0; i < 100; i++)
            {
                cron.previous();
                timestamp = cron.getStringDateStamp();
            }

        };

        this.testCase4 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("1,2,3,4,5    1/5   5   *   */2");
            cron.setCurrentTimeExt(new Date(2010, 4, 26, 10, 51, 0, 0));

            var timestamp = '';
            for (var i = 0; i < 100; i++)
            {
                cron.next();
                timestamp = cron.getStringDateStamp();
            }

            for (var i = 0; i < 100; i++)
            {
                cron.previous();
                timestamp = cron.getStringDateStamp();
            }

        };

        this.testCase5 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("0    5/5   *   *   6");

            cron.setCurrentTime(51, 10, 25, 4, 2010);
            cron.next();
            var timestamp = cron.getStringDateStamp();
            cron.next();
            timestamp = cron.getStringDateStamp();
            cron.next();
            timestamp = cron.getStringDateStamp();

            cron.setCurrentTime(51, 10, 26, 4, 2010);
            cron.previous();
            timestamp = cron.getStringDateStamp();
            cron.previous();
            timestamp = cron.getStringDateStamp();
            cron.previous();
            timestamp = cron.getStringDateStamp();
        };

        this.testCase6 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("*/5    *   *   *   *");
            cron.setCurrentTimeExt(new Date(2010, 4, 29, 0, 0, 0, 0));
            cron.getAllNextTill(new Date(2010, 4, 29, 23, 59, 0, 0), function (dates)
            {

            }, 10);

            var cron2 = new scheduler.scheduler();
            cron2.fromString("*/5    *   *   *   *");
            cron2.setCurrentTimeExt(new Date(2010, 4, 29, 0, 0, 0, 0));
            cron2.getAllPreviousTill(new Date(2010, 4, 23, 10, 51, 0, 0), function (dates)
            {

            }, 10);
        };

        this.testCase7 = function ()
        {
            var cron = new scheduler.scheduler();
            cron.fromString("4-20,25-30  4   *   *   *");
            cron.setCurrentTimeExt(new Date(2010, 4, 29, 0, 0, 0, 0));
            cron.getAllNextTill(new Date(2010, 4, 29, 23, 59, 0, 0), function (dates)
            {

            }, 0);

            var str = cron.toString();

            var cron2 = new scheduler.scheduler();
            cron2.fromString("4-20,25-30  *   *   *   *");
            cron2.setCurrentTimeExt(new Date(2010, 4, 29, 0, 0, 0, 0));
            cron2.getAllPreviousTill(new Date(2010, 4, 23, 10, 51, 0, 0), function (dates)
            {

            }, -1);
        };

        this.testCase8 = function ()
        {
            var tasks = new scheduler.taskManager();

            tasks.addTask(new scheduler.task("0/2  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';

            }, "done"));

            tasks.addTask(new scheduler.task("0/10  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';
            }, "done"));

            tasks.addTask(new scheduler.task("0/5  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';
            }, "done"));

            tasks.addTask(new scheduler.task("0/20  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';
            }, "done"));

            tasks.addTask(new scheduler.task("0/40  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';
            }, "done"));

            tasks.addTask(new scheduler.task("0/35  *   *   *   *", function (task, args)
            {
                var el = document.getElementById('completedId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + ', ' + args + '\r\n';
            }, "done"));

            tasks.enumerate(function (task, args)
            {
                var el = document.getElementById('scheduledId');
                el.value += 'Task Id: ' + task.getId() + ', schedule: ' + task.getScheduler().toString() + '\r\n';
            });

            var el = document.getElementById('buttonId');
            el.onclick = function ()
            {
                var el = document.getElementById('textId');
                tasks.removeTask(el.value);
            };

            tasks.start();
        };
    }

})();


if ( document.addEventListener ) 
{
    document.addEventListener("DOMContentLoaded", function ()
    {
        document.removeEventListener( "DOMContentLoaded", arguments.callee, false );

        scheduler.onload();

    }, false);

} else if (document.attachEvent)
{
    document.attachEvent("onreadystatechange", function ()
    {
        if (document.readyState === "complete")
        {
            document.detachEvent("onreadystatechange", arguments.callee);

            scheduler.onload();
        }
    });
}

scheduler.onload = function ()
{
    console.log('Start test cases');
    var test = new scheduler.scheduleTest();
    test.testCase1();
    test.testCase2();
    test.testCase3();
    test.testCase4();
    test.testCase5();
    test.testCase6();
    test.testCase7();
    test.testCase8();
    console.log('done');
};
