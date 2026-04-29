<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'PASCER'; ?> - Pasar Cerdas</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #E5F3FF;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, #0060AF, #4582FF);
            color: white;
            padding: 25px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        header h1 {
            text-align: center;
            font-size: 2.2em;
            font-weight: 700;
        }

        header p {
            text-align: center;
            opacity: 0.9;
        }

        /* NAV */
        .nav {
            background: white;
            border-radius: 12px;
            padding: 12px;
            margin: 20px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .nav a {
            text-decoration: none;
            color: #0060AF;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav a:hover {
            background: #0060AF;
            color: white;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        /* BUTTON */
        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-primary {
            background: #0060AF;
            color: white;
        }

        .btn-primary:hover {
            background: #004a87;
        }

        .btn-success {
            background: #00A86B;
            color: white;
        }

        .btn-success:hover {
            background: #008f5a;
        }

        .btn-danger {
            background: #E53935;
            color: white;
        }

        .btn-warning {
            background: #FFC107;
            color: #333;
        }

        .btn-info {
            background: #4582FF;
            color: white;
        }

        /* FORM */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #0060AF;
            outline: none;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #0060AF;
            color: white;
        }

        th, td {
            padding: 12px;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f2f8ff;
        }

        /* IMAGE */
        .post-image {
            max-width: 90px;
            border-radius: 6px;
        }

        .post-detail-image {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
            margin: 20px 0;
        }

        /* ALERT */
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        /* FOOTER */
        footer {
            background: #003B73;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        .back-link {
            margin-bottom: 15px;
            display: inline-block;
        }
    </style>
</head>

<body>

<header>
    <div class="container">
        <h1>🏪 PASCER</h1>
        <p>Pasar Cerdas Kabupaten Bandung</p>
    </div>
</header>

<div class="container">

    <div class="nav">
        <ul>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url('posts'); ?>">Katalog</a></li>
            <li><a href="<?php echo base_url('posts/create'); ?>">Tambah Katalog</a></li>
        </ul>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            ✓ <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-error">
            ✗ <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>