<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHIBB - Documentation</title>

    <link href="//fonts.googleapis.com/css?family=Raleway:400,500,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.rawgit.com/afeld/bootstrap-toc/v0.4.1/dist/bootstrap-toc.min.css">

    <link rel="stylesheet" href="assets/css/styles.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/afeld/bootstrap-toc/v0.4.1/dist/bootstrap-toc.min.js"></script>

    <script src="assets/js/scripts.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container docs">
        <div class="row">
            <div class="col-sm-3">
                <div class="affix">
                    <h3 data-toc-skip>Table of contents</h3>
                    <nav id="toc"></nav>
                </div>
            </div>

            <div class="col-sm-9">
                <h1>CHIBB - Documentation</h1>
                <hr>
                <p>
                    To allow all students to access sensor-data, the project is separated in three different components. Data accumulation will be provided, data processing should be
                    implemented by the group and data visualization is ideally implemented individually.
                </p>
                <hr>








                <h2>1 - Data accumulation</h2>
                <p>
                    All information that is being sent by sensors should be accumulated in one central system. This system should be lightweight so it does not consume a lot of battery
                    power from the connected sensors. A possible solution would be the MQTT-protocol, provided by an Azure IoT (Internet of Things) Hub. Thus, all sensors will send
                    their data to a specific channel and any student will be able to listen to these channels and process the data as desired. By using Azure for the MQTT-broker, we
                    create a scalable solution for further development.
                </p>
                <h3>Server-configuration</h3>
                <p>To prevent costs, we currently use an HRO-server instead of an Azure IoT Hub.</p>
                <p>The HRO-server has the following specifications:</p>
                <ul>
                    <li>LAMP-stack
                        <ul>
                            <li><strong>L</strong>inux Ubuntu 16.04.1</li>
                            <li><strong>A</strong>pache 2.4.18</li>
                            <li><strong>M</strong>ySQL 5.7.17</li>
                            <li><strong>P</strong>HP 7.0.13</li>
                        </ul>
                    </li>
                    <li>Mosquitto 1.4.8</li>
                </ul>

                <h3>Connecting</h3>
                <p>The following settings can be used to connection to the MQTT-broker. The Mosquitto-distribution runs on secure websockets with username and password protection. The
                    <a href="http://www.hivemq.com/demos/websocket-client/" target="_blank">HiveMQ Websocket Client</a> is useful for testing your connection.</p>
                <ul>
                    <li><strong>Host:</strong> <em>mqtt.chibb-box.nl</em></li>
                    <li><strong>Port:</strong> <em>8083</em></li>
                    <li><strong>SSL:</strong> <em>Yes</em></li>
                    <li><strong>Username/password:</strong> <em>Please use the username and password provided or send a request by mail to <a href="mailto:0864155@hr.nl">0864155@hr.nl</a>.</em>
                    </li>
                    <li><strong>Sensor-channel:</strong> <em>sensors</em></li>
                </ul>

                <h3>Sensor-data</h3>
                <p>
                    There is a need for a specification to lay down some rules how sensor data is being formatted (JSON). Each sensor in the CHIBB-network should send data according to
                    the following specification to allow proper data-processing. Thus, the data-processing system can always process sensor-data from the MQTT-channel.
                </p>
                <p>The data will always be represented as JSON in the following format:</p>
                <pre class="json"><?php
					echo json_encode(array(
						'uuid' => '4313080d-89b9-4c03-81f6-9b11e31cb4d7',
                        'location' => 'CHIBB',
						'readings' => array(
							array(
								'type' => 'temperature',
								'reading' => 20.1,
								'unit' => 'Celcius',
								'timestamp' => 1487318174
							),
							array(
								'type' => 'temperature',
								'reading' => 20.2,
								'unit' => 'Celcius',
								'timestamp' => 1487318184
							), array(
								'type' => 'temperature',
								'reading' => 20.3,
								'unit' => 'Celcius',
								'timestamp' => 1487318194
							)
						),
						'battery' => 78.00
					), JSON_PRETTY_PRINT);
					?>
                        </pre>
                <br>
                <p>Explanations:</p>
                <ul>
                    <li><strong>uuid</strong> <em>string</em> An unique ID for the sensor</li>
                    <li><strong>location</strong> <em>string</em> The location of the sensor. Currently, this will only be CHIBB. But in the future more smart homes could be added.</li>
                    <li>
                        <strong>readings</strong> <em>array</em> One sensor casing can include multiple readings:
                        <ul>
                            <li><strong>type</strong> <em>string</em> The type of sensor, one of the following constants: </li>
                            <li><strong>reading</strong> <em>float</em> The reading itself</li>
                            <li><strong>unit</strong> <em>string</em> The unit of the reading, one of the following constants: </li>
                            <li><strong>timestamp</strong> <em>integer</em> When the reading occurred. Sensors may buffer readings to save battery-life or when they are offline.</li>
                        </ul>
                    </li>
                    <li><strong>battery</strong> <em>float</em> Battery reading, use 100.0 when the sensor is attached to a AC/DC-output.</li>
                </ul>
                <p>
                    Other sensor-data in the JSON-string should be ignored. Corrections of deviations should occur in the sensor itself or in the visualization component. Naming sensors to recognize the position in the smart home should occur in the visualization as well.
                </p>

                <h3>Dummy data</h3>
                <p>Please note the MQTT-broker is now sending completely random dummy-data onto the sensors channel and is not connected to any of the sensors inside CHIBB.</p>
                <hr>














                <h2>2 - Data processing</h2>
                <p>
                    Every student willing to process data in their project will now be able to listen to the MQTT-channels and catch data coming from the sensors. This could be parsing
                    to any sort of database, relational or non-relational.
                </p>
                <p>
                    Now the sensor-data is being sent onto the MQTT-channel, we can move on to the next step. Messages on a MQTT-channel are only sent once and will not be
                    stored for later use. Therefore, we need some sort of database. While relational databases are most commonly used, it might be better to look ahead.
                    With 10 sensors sending their readings every minute, we already have 14.400 readings every day. Over a year, this would result in more than 5 million records.
                </p>
                <h3>NoSQL</h3>
                <p>
                    <a href="https://www.mongodb.com" target="_blank">MongoDB</a> has <a href="https://www.mongodb.com/use-cases/internet-of-things" target="_blank">published a white paper</a>
                    on their website describing a use-case of MongoDB with Internet of Things. NoSQL-databases are much better capable of handling huge amounts of data while
                    maintaining their performance. Some alternatives besides MongoDB could be <a href="https://www.influxdata.com" target="_blank">InfluxDB</a> or
                    <a href="http://cassandra.apache.org" target="_blank">Apache Cassandra</a>.
                </p>
                <h3>NodeJS</h3>
                <p>
                    Now that we have chosen our database, the sensor-data from the MQTT-channel needs to be processed. Thanks to the rules laid down in tab 1, every reading
                    will have the same JSON structure. We just need a relay to move the sensor-data into MongoDB.
                </p>
                <p>
                    NodeJS is perfectly capable of listening to websockets and thanks to Mosquitto, we can combine these two! With NodeJS listening to the MQTT-channel using
                    secure websockets, we can relay the sensor-data into MongoDB.
                </p>
                <hr>










                <h2>3 - Data visualization</h2>
                <p>
                    After all data has been processed, it is ready to be presented to the user. Every student can decide how their data will be presented, for example web-apps or
                    mobile-apps.
                </p>
                <p>
                    The last but most important step in this project is to visualize the data for the user. This is where all systems come together and create something useful.
                    With our data inside the MongoDB-database, we can create various types of visualizations.
                </p>
                <p>
                    During this stage of the project, I would like to create a responsive web application. This application can then be used on desktops, as well as tablets and
                    smartphones. The web application will be built on the Symfony PHP Framework using a Bootstrap front-end base.
                </p>
                <p>
                    While sensor-data is being saved by their UUID, it would be nice to assign a name and possibly a position to them. The visualization part is responsible for
                    presenting the data to the user and naming and positioning sensors should not occur before this point. With sensors being mobile, the owner of the house
                    could easily move the sensors to an other position inside the house and rename the sensor in the visualization application.
                </p>
                <p style="color:#e67e22;">
                    <em><strong>Yet to decide: use an API from NodeJS or run Symfony directly with MongoDB?</strong></em><br>
                    It would be nice to provide an API to the visualization applications to allow various simultaneous systems like an web application and/or a smartphone app.
                </p>
                <hr>





                <h2>Security</h2>
                <p>
                    To ensure all sensor-data is transferred through the internet in a secure manner, SSL is used on all user-accessible domains. The certificates are provided by
                    <a href="https://letsencrypt.org" target="_blank">Let's Encrypt</a>. While the certificates are only valid for 90 days, a cronjob will be running to renew them.
                </p>
                <hr>





                <h2>Version control</h2>
                <p>This documentation as well as all code is managed in GitHub. Please see the following links to their respective repositories:</p>
                <ul>
                    <li>Documentation: <a href="https://github.com/jerome2710/ictlab-documentation" target="_blank">https://github.com/jerome2710/ictlab-documentation</a></li>
                    <li>NodeJS processor & API: <a href="https://github.com/jerome2710/ictlab-api" target="_blank">https://github.com/jerome2710/ictlab-api</a></li>
                    <li>Symfony visualization: <a href="https://github.com/jerome2710/ictlab-dashboard" target="_blank">https://github.com/jerome2710/ictlab-dashboard</a></li>
                </ul>
                <hr>





                <h2>Continuous deployment</h2>
                <p>For the ease of development, Jenkins will be used for continuous deployment. For every push to the master-branch of one of the repositories, the Jenkins-job will be triggerd.</p>
                <h3>Code Quality</h3>
                <p>Jenkins is also responsible for monitoring code quality throughout the system. The NodeJS-component will be checked with <a href="http://jshint.com" target="_blank">JSHint</a>  and the Symfony-component with <a href="http://pear.php.net/package/PHP_CodeSniffer/" target="_blank">PHP CodeSniffer</a>.</p>
                <hr>





                <h2>Planning</h2>
                <p>The planning below shows an indication of when the stated activities should be executed and when any deliverables should be completed.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="font-weight:bold;">
                            <tr class="active">
                                <td style="width:15%;">Course week</td>
                                <td style="width:15%;">Week</td>
                                <td style="width:35%;">Activities</td>
                                <td style="width:35%;">Deliverables</td>
                            </tr>
                        </thead>
                        <?php
                            function rowClass($week) {
                                $curWeek = date('W');
                                if ($week == $curWeek) {
                                    return ' class="warning"';
                                } elseif ($week < $curWeek) {
                                    return ' class="success"';
                                }
                                return '';
                            }
                        ?>
                        <tbody>
                            <tr<?php print rowClass(7); ?>>
                                <td>2</td>
                                <td>7</td>
                                <td>Kick-off & server configuration</td>
                                <td>Teams</td>
                            </tr>
                            <tr<?php print rowClass(8); ?>>
                                <td>3</td>
                                <td>8</td>
                                <td>
                                    Server configuration<br>
                                    Data accumulation (MQTT)
                                </td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(9); ?>>
                                <td></td>
                                <td>9</td>
                                <td>Data accumulation (MQTT)</td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(10); ?>>
                                <td>4</td>
                                <td>10</td>
                                <td>Data processing (NodeJS & API)</td>
                                <td>Planning</td>
                            </tr>
                            <tr<?php print rowClass(11); ?>>
                                <td>5</td>
                                <td>11</td>
                                <td>Data processing (NodeJS & API)</td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(12); ?>>
                                <td>6</td>
                                <td>12</td>
                                <td>Data processing (NodeJS & API)</td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(13); ?>>
                                <td>7</td>
                                <td>13</td>
                                <td>Data processing (NodeJS & API)</td>
                                <td>Planning</td>
                            </tr>
                            <tr<?php print rowClass(14); ?>>
                                <td>8</td>
                                <td>14</td>
                                <td>Data visualization (Symfony)</td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(15); ?>>
                                <td>9</td>
                                <td>15</td>
                                <td>Data visualization (Symfony)</td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(16); ?>>
                                <td>10</td>
                                <td>16</td>
                                <td>Data visualization (Symfony)</td>
                                <td>
                                    Working prototype<br>
                                    Presentation
                                </td>
                            </tr>
                            <tr<?php print rowClass(17); ?>>
                                <td></td>
                                <td>17</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(18); ?>>
                                <td>11</td>
                                <td>18</td>
                                <td></td>
                                <td>Planning</td>
                            </tr>
                            <tr<?php print rowClass(19); ?>>
                                <td>12</td>
                                <td>19</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(20); ?>>
                                <td>13</td>
                                <td>20</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(21); ?>>
                                <td>14</td>
                                <td>21</td>
                                <td></td>
                                <td>Planning</td>
                            </tr>
                            <tr<?php print rowClass(22); ?>>
                                <td>15</td>
                                <td>22</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(23); ?>>
                                <td>16</td>
                                <td>23</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr<?php print rowClass(24); ?>>
                                <td>17</td>
                                <td>24</td>
                                <td></td>
                                <td>
                                    Final product<br>
                                    Presentation
                                </td>
                            </tr>
                            <tr<?php print rowClass(25); ?>>
                                <td>18</td>
                                <td>25</td>
                                <td></td>
                                <td><strong>Final Assessment</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>



                <h2>Presentations</h2>
                <p>The following links will redirect to presentations made in <a href="https://slides.com" target="_blank">Slides.com</a>.</p>
                <ul>
                    <li><strong>Week 10</strong>: <a href="http://slides.com/jerome2710/ictlab-week-10" target="_blank">http://slides.com/jerome2710/ictlab-week-10</a></li>
                </ul>
                <hr>




                <h2>Student information</h2>
                <p>
                    Jerome Anker <<a href="mailto:0864155@hr.nl">0864155@hr.nl</a>><br>
                    ICT Lab 2016/2017<br>
                    Hogeschool Rotterdam
                </p>
            </div>
        </div>
    </div>
</body>
</html>