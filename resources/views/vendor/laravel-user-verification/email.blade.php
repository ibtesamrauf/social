<!-- Click here to verify your account: <a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email)}}">{{ $link }}</a> -->
Click here to verify your account: <a href="{{ $link = url('email-verifications.custom', $user->verification_token) . '?email=' . urlencode($user->email) . '&table=' . $user->table }}">{{ $link }}</a>
