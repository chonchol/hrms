<!DOCTYPE html>
<html>
<head>
    <title>HAEFA | HRM System</title>
</head>
<body>
    <!-- @foreach($data as $dt) -->
    <p>Dear Sir</p>
    <p>I am {{$first_name}} {{$last_name}} working as a {{$designation}} in {{$department}}. I am writing to request you for a {{$days_count}} days leave from {{ $start_date }} to {{ $end_date }} beacuse of {{ $description }}. I will resume work from  resume_work , and I shall be reachable at my email id {{ $email }} and phone number {{$mobile}} during this period. Please grant me leave on those days.</p>
    <p>Yours Sincerely,<br>
    {{$first_name}}<br>
    {{$designation}}, {{$department}}<br>
    Health and Education for All(HAEFA)</p>
    <!-- @endforeach -->
    <button class="" type="submit">Approve</button>
    <button class="" type="submit">Decline</button>
</body>
</html>