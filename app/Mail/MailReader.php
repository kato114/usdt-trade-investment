<?php


namespace App\Mail;


use Exception;

class MailReader
{
    protected $username;
    protected $password;
    protected $imap = false;

    /**
     * MailReader constructor.
     * @param $username
     * @param $password
     * @throws Exception
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function open()
    {
        $this->imap = imap_open('{' . env('MAILBOX_ADDRESS') . ':143/notls}', $this->username, $this->password);
        if ($this->imap == false) {
            throw new Exception(imap_last_error());
        }
    }

    public function close()
    {
        if ($this->imap !== false) {
            imap_close($this->imap);
        }
        $this->imap = false;
    }

    public function emailsLastFourDays()
    {
        $criteria = 'SINCE "' . now()->subDays(14)->startOfDay()->format("j F Y") . '"';
        return $this->search($criteria);
    }

    /**
     * @param $criteria
     * @return \Illuminate\Support\Collection
     */
    public function search($criteria)
    {
        $key = "imap_cache_" . $this->username . md5($criteria);
        if (!cache()->has($key)) {
            if ($this->imap === false) {
                $this->open();
            }
            $data = collect(imap_search($this->imap, $criteria))->map(function ($x) {
                $email = (object)imap_fetch_overview($this->imap, $x)[0];
                if (preg_match("/(?<=\<)(.*?)(?=\>)/", $email->from, $matches) === 1) {
                    $email->from = $matches[0];
                }
                $email->body = htmlentities(imap_fetchbody($this->imap, $x, 1, FT_PEEK));
                return $email;
            });
            $this->close();
            cache()->put($key, $data, now()->addMinutes(30));
        }
        return cache($key);

    }

    public function mailsLastSevenDays()
    {
        $criteria = 'SINCE "' . date("j F Y", strtotime("-7 days")) . '"';
        return $this->search($criteria);
    }
}
