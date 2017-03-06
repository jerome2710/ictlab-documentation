<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHIBB - Documentation</title>

    <link href="//fonts.googleapis.com/css?family=Raleway:400,500,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style type="text/css">
        body {
            font-size: 15px;
            line-height: 1.333;
            font-family: 'Raleway', Helvetica, Verdana, Arial, sans-serif;
            background-color: #303030;
        }

        .docs {
            margin: 15px auto;
            padding: 35px;
            background-color: #ecf0f1;
        }

        h1 {
            font-weight: 800;
        }

        .nav-tabs li a {
            font-size: 18px;
        }

        .tab-pane {
            background-color: #dde0e2;
            padding: 20px;
        }

        hr {
            border-top: 1px solid #bdc3c7;
        }

        /* JSON code snippets */
        pre {
            outline: 1px solid #ccc;
            padding: 5px;
            margin: 5px;
        }

        .string {
            color: green;
        }

        .number {
            color: darkorange;
        }

        .boolean {
            color: blue;
        }

        .null {
            color: magenta;
        }

        .key {
            color: red;
        }

        .copyright {
            margin-top: 25px;
            font-style: italic;
            text-align: center;
        }
    </style>

    <script type="text/javascript">
        function syntaxHighlight(json) {
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        }

        $(document).ready(function () {
            $('.json').html(syntaxHighlight($('.json').html()));
        });
    </script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
</head>
<body>
<div class="container docs">
    <div class="row">
        <div class="col-md-12">
            <h1>CHIBB - Documentation</h1>
            <hr>
            <p>
                To allow all students to access sensor-data, the project is separated in three different components. Data accumulation will be provided, data processing should be
                implemented by the group and data visualization is ideally implemented individually.
            </p>
            <p><strong>1 - Data accumulation</strong></p>
            <p>
                All information that is being sent by sensors should be accumulated in one central system. This system should be lightweight so it does not consume a lot of battery
                power from the connected sensors. A possible solution would be the MQTT-protocol, provided by an Azure IoT (Internet of Things) Hub. Thus, all sensors will send
                their data to a specific channel and any student will be able to listen to these channels and process the data as desired. By using Azure for the MQTT-broker, we
                create a scalable solution for further development.
            </p>

            <p><strong>2 - Data processing</strong></p>
            <p>
                Every student willing to process data in their project will now be able to listen to the MQTT-channels and catch data coming from the sensors. This could be parsing
                to any sort of database, relational or non-relational.
            </p>

            <p><strong>3 - Data visualization</strong></p>
            <p>
                After all data has been processed, it is ready to be presented to the user. Every student can decide how their data will be presented, for example web-apps or
                mobile-apps.
            </p>
            <hr>

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#accumulation" aria-controls="accumulation" role="tab" data-toggle="tab">Accumulation</a></li>
                <li role="presentation"><a href="#processing" aria-controls="processing" role="tab" data-toggle="tab">Processing</a></li>
                <li role="presentation"><a href="#visualization" aria-controls="visualization" role="tab" data-toggle="tab">Visualization</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="accumulation">
                    <h2>MQTT</h2>
                    <hr>
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

                    <p><strong>Connection</strong></p>
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

                    <p><strong>Sensor-data</strong></p>
                    <p>
                        There is a need for a specification to lay down some rules how sensor data is being formatted (JSON). Each sensor in the CHIBB-network should send data according to
                        the following specification to allow proper data-processing. Thus, the data-processing system can always process sensor-data from the MQTT-channel.
                    </p>
                    <p>The data will always be represented as JSON in the following format:</p>
                    <pre class="json"><?php
						echo json_encode(array(
							'uuid' => '4313080d-89b9-4c03-81f6-9b11e31cb4d7',
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

                    <p><strong>Dummy data</strong></p>
                    <p>Please note the MQTT-broker is now sending completely random dummy-data onto the sensors channel and is not connected to any of the sensors inside CHIBB.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="processing">
                    <p>
                        Now the sensor-data is being sent onto the MQTT-channel, we can move on to the next step. Messages on a MQTT-channel are only sent once and will not be
                        stored for later use. Therefore, we need some sort of database. While relational databases are most commonly used, it might be better to look ahead.
                        With 10 sensors sending their readings every minute, we already have 14.400 readings every day. Over a year, this would result in more than 5 million records.
                    </p>
                    <h2>NoSQL</h2>
                    <p>
                        <a href="https://www.mongodb.com" target="_blank">MongoDB</a> has <a href="https://www.mongodb.com/use-cases/internet-of-things" target="_blank">published a white paper</a>
                        on their website describing a use-case of MongoDB with Internet of Things. NoSQL-databases are much better capable of handling huge amounts of data while
                        maintaining their performance. Some alternatives besides MongoDB could be <a href="https://www.influxdata.com" target="_blank">InfluxDB</a> or
                        <a href="http://cassandra.apache.org" target="_blank">Apache Cassandra</a>.
                    </p>
                    <h2>NodeJS</h2>
                    <p>
                        Now that we have chosen our database, the sensor-data from the MQTT-channel needs to be processed. Thanks to the rules laid down in tab 1, every reading
                        will have the same JSON structure. We just need a relay to move the sensor-data into MongoDB.
                    </p>
                    <p>
                        NodeJS is perfectly capable of listening to websockets and thanks to Mosquitto, we can combine these two! With NodeJS listening to the MQTT-channel using
                        secure websockets, we can relay the sensor-data into MongoDB.
                    </p>
                </div>
                <div role="tabpanel" class="tab-pane" id="visualization">
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
                </div>
            </div>
        </div>
    </div>
    <div class="row copyright">
        <div class="col-md-12">
            <p>
                Jerome Anker <0864155@hr.nl><br>
                ICT Lab 2016/2017<br>
                Hogeschool Rotterdam
            </p>
        </div>
    </div>
</div>
</body>
</html>