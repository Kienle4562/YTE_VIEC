<?php

function application_start()
{
    global $_APP;

    // if data file exists, load application
    //   variables
    if (file_exists(APP_DATA_FILE))
    {
    	$data = file_get_contents(APP_DATA_FILE);
    	
    	/*
        // read data file
        $file = fopen(APP_DATA_FILE, "r");
        if ($file)
        {
            $data = fread($file,
                filesize(APP_DATA_FILE));
            fclose($file);
        }
        */
        
        // build application variables from
        //   data file
        if ($data !== FALSE)
        {
        	$_APP = unserialize($data);
		}
		else
		{
			die('Application error!');
		}
    }
}

function application_end()
{
    global $_APP;

    // write application data to file
    $data = serialize($_APP);
    
    if (file_put_contents(APP_DATA_FILE, $data) === FALSE)
    {
		die('Application error!');
    }
    
    /*
    $file = fopen(APP_DATA_FILE, "w");
    if ($file)
    {
        fwrite($file, $data);
        fclose($file);
    }
    */
}

application_start();