<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="/public/js/groupInfo.js"></script>
    </head>
    <body>
        <form action="/TestDB/test" method="post">
        변경할 신청날짜<input type="text" class="datetimes" name="sign_time" value=""/><br>
        <button type="submit">제출</button>
        </form>
    </body>
</html>