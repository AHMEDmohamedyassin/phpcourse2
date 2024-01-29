<?php include_once(__DIR__.'/Header.php') ?>

<h1>routes : </h1>
<ol>
    <li><a href="/create">create</a></li>
    <li><a href="/upload">upload</a></li>
    <li><a href="/add">add</a></li>
    <li><a href="/download">download</a></li>
    <li><a href="/generator">generator</a></li>
    <li><a href="/mail">mail</a></li>
    <li><a href="/curl">curl</a></li>
    <li>
        <ul>
            <h1>database</h1>
            <li><a href="/db">db</a></li>
            <li><a href="/db/insert?name=ahmed&email=ahmed@ahmed.com">insert</a></li>
            <li><a href="/db/get?search=ah">get</a></li>
            <li><a href="/db/update?email=ahmedupdated@updated.com&id=21">update</a></li>
            <li><a href="/db/delete?id=22">delete</a></li>
            <li><a href="/db/droptable?table=invoices">droptable</a></li>
            <li><a href="/db/rel/insert">insert</a></li>
            <li><a href="/db/rel/get">get</a></li>
            <li><a href="/db/transaction">transaction</a></li>
        </ul>
    </li>
</ol>


