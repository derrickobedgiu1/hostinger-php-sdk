<?php

namespace DerrickOb\HostingerApi\Enums;

enum Protocol: string
{
    case TCP = 'TCP';
    case UDP = 'UDP';
    case ICMP = 'ICMP';
    case GRE = 'GRE';
    case ANY = 'any';
    case ESP = 'ESP';
    case AH = 'AH';
    case ICMPv6 = 'ICMPv6';
    case SSH = 'SSH';
    case HTTP = 'HTTP';
    case HTTPS = 'HTTPS';
    case MYSQL = 'MySQL';
    case POSTGRESQL = 'PostgreSQL';
}
