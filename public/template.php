<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="https://unpkg.com/cirrus-ui/dist/cirrus.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Tasks</h1>
    </header>
    <main id="root">
        <?php
        require_once __DIR__ . '/../vendor/autoload.php';

        use App\Views\TaskFormView;

        $taskFormView = new TaskFormView();
        echo $taskFormView->render();
        ?>
        <section>
            <ul id="task-list" class="task-list">
                <?php
                echo $taskController->list();
                ?>
            </ul>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@1.8.4"></script>
    <script>
        'use strict';

        document.body.addEventListener('htmx:load', handleHtmxEvent);

        function handleHtmxEvent(event) {
            try {
                const eventType = event.type;
                const targetElement = event.target;
                const detail = event.detail;

                console.groupCollapsed(`HTMX Event: ${eventType}`);
                console.log('Target Element:', targetElement);
                console.log('Event Detail:', detail);
                console.groupEnd();
            } catch (error) {
                console.error('Error handling HTMX event:', error);
            }
        }
    </script>
</body>
</html>
