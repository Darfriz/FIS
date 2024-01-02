// weather_section.dart
import 'package:flutter/material.dart';

class WeatherSection extends StatelessWidget {
  final IconData icon;
  final String temperature;
  final String condition;
  final double width;

  const WeatherSection({
    Key? key,
    required this.icon,
    required this.temperature,
    required this.condition,
    required this.width,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      width: width,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.8),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.5),
            spreadRadius: 1,
            blurRadius: 3,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Column(
        children: [
          Icon(icon, size: 48, color: Colors.blue),
          const SizedBox(height: 8),
          Text(temperature, style: const TextStyle(fontSize: 24)),
          Text(condition, style: const TextStyle(fontSize: 18)),
        ],
      ),
    );
  }
}
