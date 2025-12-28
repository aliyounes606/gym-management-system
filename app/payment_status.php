<?php

namespace App;

enum payment_status: string 
{
    case paid = 'paid';
    case pending = 'pending';
}
