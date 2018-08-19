<?php

namespace Sarfraznawaz2005\LogNotify\Console;

use Illuminate\Console\Command;

class SocketServerCommand extends Command
{
    protected $name = 'lognotify:serve';
    protected $description = 'Starts websocket server.';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        set_time_limit(0);

        # keep script running always
        ignore_user_abort(true);

        $server = new \vakata\websocket\Server(config('logNotify.socket_url'));

        $server->onMessage(function ($sender, $message, $server) {
            foreach ($server->getClients() as $client) {
                if ((int)$sender['socket'] !== (int)$client['socket']) {

                    $data = json_decode($message);

                    $server->send($client['socket'], $message);
                }
            }
        });

        $server->run();
    }
}
