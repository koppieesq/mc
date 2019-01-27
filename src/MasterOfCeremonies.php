<?php
/**
 * Created by PhpStorm.
 * User: jkoplowicz
 * Date: 2019-01-25
 * Time: 13:38
 */

namespace MC;

class MasterOfCeremonies
{
    /**
     * Reusable function to report whether the previous step succeeded.
     *
     * @param object $result
     *   Pass the result object to this function.
     * @param string $task
     *   Plain text description of the currently running task.
     *
     * @return int
     *   Should correctly report whether task was successful or not.
     */
    function check_success($result = NULL, $task = "Current task") {
        if (!$result) {
            $message = $this->io()->error("Sorry, something went wrong with $task");
            exit($message);
        }
        elseif ($result->wasSuccessful()) {
            $this->io()->success("$task was successful!");
            return 0;
        }
        else {
            $message = $this->io()->error("Sorry, something went wrong with $task");
            exit($message);
        }
    }

    /**
     * Check Application
     *
     * Accepts a string
     *
     * @param string $check
     *
     * @return string
     */
    function check_app(string $check) {
        $found = exec("which $check");
        $result = $found ? $found : 'echo';

        return $result;
    }

    /**
     * Calculate & report elapsed time for this task.
     *
     * @param $start_time
     *   The time you began.
     */
    function stopwatch($start_time) {
        $stop_time = time();
        $elapsed_time = $stop_time - $start_time;
        $elapsed_minutes = floor($elapsed_time / 60);
        $elapsed_seconds = $elapsed_time - $elapsed_minutes * 60;
        $this->say("This took $elapsed_minutes minutes and $elapsed_seconds seconds.");

        return;
    }

    /**
     * Say something using figlet and lolcat.
     *
     * Figlet outputs a string using bubble letters, and lolcat outputs the
     * string with rainbow letters.  Example:
     *   _   _      _ _        __        __         _     _
     *  | | | | ___| | | ___   \ \      / /__  _ __| | __| |
     *  | |_| |/ _ \ | |/ _ \   \ \ /\ / / _ \| '__| |/ _` |
     *  |  _  |  __/ | | (_) |   \ V  V / (_) | |  | | (_| |
     *  |_| |_|\___|_|_|\___/     \_/\_/ \___/|_|  |_|\__,_|
     *
     * @param string $say
     *   String to be rendered
     *
     * @return void
     */
    function catlet(string $say = 'Hello World') {
        $checks = ['lolcat', 'figlet', 'cowsay', 'fortune'];
        $lolcat = exec('which lolcat');
        foreach ($checks as $check) {
            $found = exec("which $check");
            $$check = $found ? $found : 'echo';
        }
        $this->taskExec("$figlet $say | $lolcat")
            ->silent(TRUE)
            ->printOutput(TRUE)
            ->run();

        return;
    }

    /**
     * Reusable introduction.
     *
     * This function takes 3 arguments: your header, your intro, and a list of
     * things.  The headline gets displayed in figlet default puffy letter
     * style, your introduction gets displayed as a simple say(), and the list
     * rendered using io()->listing().  Finally, it asks the user if they want
     * to continue.  Continuing is a simple matter of pressing "enter"; if they
     * do, then the function will return TRUE (in case you need it).  If they
     * type ctl-C, then they will escape the entire program.
     *
     * @param string $banner
     *   Say it in lights.
     * @param string $intro
     *   Say it in normal words.
     * @param null $list
     *   What are you going to do?
     *
     * @return bool
     */
    function intro(string $banner = 'Hi!', string $intro = '', $list = NULL) {
        // Can't pass NULL to io->listing().
        $list = $list ? $list : ["(Sorry, not actually sure what I *can* do!)"];

        // Display in glorious fashion
        $this->catlet($banner);
        $this->say($intro . "  Here's what I can do:");
        $this->io()->listing($list);

        // Simple confirmation: anything to continue; ctl-C to escape.
        $this->say("Do you want me to do this?");
        $this->ask("Press [ENTER] to continue, ctrl-C to cancel.");

        return;
    }

    /**
     * PHP implementation of tput
     *
     * Accepts human color names, eg.: ["color" => "red"]
     *
     * @param string $text
     * @param array $extra
     *
     * @return string
     */
    function tput(string $text, $extra = '') {
        // Set up variables.
        $colors = [
            'black',
            'red',
            'green',
            'yellow',
            'blue',
            'magenta',
            'cyan',
            'white',
        ];
        $command = 'tput sgr0; ';

        // If there are options, load them up.
        if (gettype($extra) == 'array') {
            foreach ($extra as $key => $value) {
                switch ($key) {
                    case 'color':
                        $command .= "tput setaf " . array_search($value, $colors) . "; ";
                        break;
                    case 'background':
                        $command .= "tput setab " . array_search($value, $colors) . "; ";
                        break;
                }
            }
        }
        elseif (!empty($extra)) {
            $command .= "tput " . $extra . "; ";
        }

        return exec($command) . $text . exec("tput sgr0");
    }

}