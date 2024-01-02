// home_page.dart
import 'package:assignment_o/flight_booking_page.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'weather_section.dart';

class HomePage extends StatelessWidget {
  final http.Client httpClient;  // Import 'package:http/http.dart' as http;

  const HomePage({Key? key, required this.httpClient}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          // Single Wallpaper for Flight Information System
          Image.network(
            'https://source.unsplash.com/1600x1200/?airplane',
            fit: BoxFit.cover,
            height: double.infinity,
            width: double.infinity,
            alignment: Alignment.center,
          ),
          Center(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  // New Title
                  const Text(
                    'FLIGHT INFORMATION SYSTEM',
                    style: TextStyle(
                      fontSize: 28,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 16),
                  // Weather and Profile in the same row
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      // Weather Section
                      const WeatherSection(
                        icon: Icons.wb_sunny,
                        temperature: '28°C',
                        condition: 'Sunny',
                        width: 150,
                      ),
                      const SizedBox(width: 16),
                      // Profile Card
                      Card(
                        elevation: 8,
                        child: Container(
                          width: 150,
                          padding: const EdgeInsets.all(16.0),
                          child: const Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            children: [
                              CircleAvatar(
                                radius: 40,
                                backgroundImage: NetworkImage(
                                    'https://placekitten.com/200/200'), // Replace with your image URL
                              ),
                              SizedBox(height: 8),
                              Text(
                                'John Doe',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              Text(
                                'UI/UX Designer',
                                style: TextStyle(color: Colors.grey, fontSize: 12),
                                textAlign: TextAlign.center,
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  ElevatedButton(
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => const FlightBookingPage()),
                      );
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blue,
                    ),
                    child: const Text('Book a Flight'),
                  ),


                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
