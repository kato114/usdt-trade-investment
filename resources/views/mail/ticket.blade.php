@extends('mail.base')
@section('content')
    <div class="main-content">
        <table class="box" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content pb-0" align="center">
                                <table class="icon icon-lg bg-green-lightest" cellspacing="0"
                                       cellpadding="0">
                                    <tr>
                                        <td valign="middle" align="center">
                                            <img
                                                src="{{ url('assets/images/message-square.png')}}"
                                                class=" va-middle" width="96" height="96"
                                                alt="check"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="content pb-0">
                                <p class="h1">{{ $ticket->subject }}</p>
                                <p>
                                    {!! str_replace("\n","<br>", $ticket->narration) !!}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="content text-center pt-0 pb-xl">
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center">
                                            <table cellpadding="0" cellspacing="0" border="0" class="bg-green rounded w-auto">
                                                <tr>
                                                    <td align="center" valign="top" class="lh-1">
                                                        <a href="{{ route('support.resolution',['action' =>'view','ticket' => $ticket]) }}" class="btn bg-green border-green">
                                                            <span class="btn-span">Open Ticket on {{ config('app.name') }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td class="content text-center border-top">
                                <p>
                                    Yours sincerely,<br>
                                    {{ config('app.name') }} Team
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
