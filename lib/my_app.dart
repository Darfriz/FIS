// my_app.dart
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'home_page.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  final http.Client httpClient = http.Client();

  MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flight Information System',
      theme: ThemeData(
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: HomePage(httpClient: httpClient),
    );
  }
}
