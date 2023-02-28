<?php

use App\Models\Transaction;

function convertDate($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function notifications()
{
	$notifications = Transaction::with('member')->select('transactions.*', DB::raw('DATEDIFF(transactions.date_end, CURRENT_DATE) as late'))->where('status', 0)->get();

	return $notifications;
}

?>

